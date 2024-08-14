<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Detail;
use App\Models\DetailValue;
use App\Models\Dimention;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductPicture;
use App\Models\ProductVariant;
use App\Models\Promo;
use App\Models\Setting;
use App\Models\Variant;
use App\Models\VariantValue;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public $picture_folder = 'product-pictures/';

    function index(Request $request): View
    {
        $queryParams = [
            'name' => ['string', 'nullable'],
        ];

        $validated = $request->validate($queryParams);

        $data = Product::with("product_variant", "promo", "auction")->latest();

        if (isset($validated["name"])) {
            $data = $data->where('name', 'like', '%' . $validated["name"] . '%');
        }
        // NUMBER OF ROWS PER PAGE
        $numbRows = $request['numbRows'] ?? 10;

        $data = $data->paginate($numbRows)->appends(array_merge($validated, ['numbRows' => $numbRows]));
        $indexNumber = (request()->input('page', 1) - 1) * $numbRows;

        // PERHATIKAN URUTAN $headers dan $rows, INI AKAN MENJADI URUTAN PADA TABEL
        $headers = [
            'No',
            'Nama',
            'Stok',
            'Harga',
            'Promo',
            'Lelang',
            'Aksi'
        ];

        $rows = $data->map(function ($item) {
            $stock = 0; // Initialize stock to 0
            $prices = []; // Initialize an empty array to hold prices

            foreach ($item->product_variant as $pv) {
                $stock += $pv->stock;
                $prices[] = $pv->price; // Add each price to the array
            }

            // Get the minimum and maximum prices from the prices array
            $minPrice = !empty($prices) ? min($prices) : 0;
            $maxPrice = !empty($prices) ? max($prices) : 0;

            // Format the price based on the number of prices
            if (count($prices) === 1) {
                $priceFormatted = 'Rp. ' . number_format($minPrice, 0, ',', '.');
            } else {
                $priceFormatted = 'Rp. ' . number_format($minPrice, 0, ',', '.') . ' - Rp. ' . number_format($maxPrice, 0, ',', '.');
            }

            // ADD PRODUCT NAME TO DATA AUCTION UNTUK DITAMPILKAN DI FORM AUCTION
            $auction = $item->auction ? array_merge($item->auction->toArray(), ['product_name' => $item->name]) : ['product_name' => $item->name, 'product_id' => $item->id];

            return [
                'name' => $item->name,
                'stock' => $stock,
                'price' => $priceFormatted,
                'promo' => $item->promo->active ?? null,
                'auction' => $auction,
                'id' => $item->id,
            ];
        });

        $routeName = 'product';

        return view('admin.product.index', compact('data', 'indexNumber', 'validated', 'numbRows', 'headers', 'rows', 'routeName', 'queryParams'));
    }


    function create(): View
    {
        $variants = Variant::limit(2)->get();
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.product.form', compact('variants', 'categories', 'brands'));
    }

    function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $new_product = new Product();
        $new_product->name = $validated["name"];
        $new_product->slug = Str::of($validated["name"])->slug('-')->value;
        $new_product->description = $validated["description"];

        DB::transaction(function () use ($new_product, $validated) {
            $new_product->save();

            // JIKA TIDAK ADA VARIANT MAKA SIMPAN SATU SAJA PADA PRODUCT VARIANT JIKA ADA VARIANT MAKA DI HANDLE DIBAWAH DIBAGIAN VARIANTS
            if (!isset($validated["variantData"])) {
                $newProductVariant = new ProductVariant();
                $newProductVariant->product_id = $new_product->id;
                $newProductVariant->stock = $validated["stock"];
                $newProductVariant->price = $validated["price"];
                $newProductVariant->weight = $validated["weight"];
                $newProductVariant->sku = $validated["sku"];
                $newProductVariant->active = $validated["active"] ?? false;
                $newProductVariant->save();
            }

            // CATEGORIES (many to many)
            if (isset($validated["categories"])) {
                $categoryIds = [];

                foreach ($validated["categories"] as $categoryId) {
                    $category = Category::find($categoryId);

                    if (!$category) {
                        // If the category does not exist, create it with the ID as the name
                        $category = Category::create(['name' => $categoryId]);
                    }

                    $categoryIds[] = $category->id;
                }

                $new_product->category()->attach($categoryIds);
            }

            // PICTURES
            if (isset($validated["product_pictures"])) {
                foreach ($validated["product_pictures"] as $product_picture) {
                    $filename = $new_product->slug . '-' . uniqid() . '.webp';
                    $path = $this->picture_folder . $filename;
                    Storage::put($path, file_get_contents($product_picture));

                    $newPicture = new ProductPicture();
                    $newPicture->product_id = $new_product->id;
                    $newPicture->path = $path;
                    $newPicture->save();
                }
            }

            // DISCOUNT (PROMO)
            $discount = $validated["discount"];
            if ($discount && $discount > 0) {
                $promo = new Promo();
                $promo->product_id = $new_product->id;
                $promo->discount = $discount;
                $promo->save();
            }

            // DIMENTION
            $dimention = new Dimention();
            $dimention->product_id = $new_product->id;
            $dimention->length = $validated["length"];
            $dimention->width = $validated["width"];
            $dimention->height = $validated["height"];
            $dimention->save();

            // DETAILS
            if (isset($validated["detail"])) {
                foreach ($validated["detail"] as $index => $detail_input) {

                    if (isset($detail_input)) { //hanya simpan detail yang tidak null
                        $detail = Detail::firstOrCreate(['detail' => $detail_input]);

                        $detail_value = new DetailValue();
                        $detail_value->detail_id = $detail->id;
                        $detail_value->product_id = $new_product->id;
                        $detail_value->value = $validated["detail-value"][$index];

                        $detail_value->save();
                    }
                }
            }

            // VARIANTS
            if (isset($validated["variantData"])) {
                $variants = json_decode($validated['variantData'], true);
                $variantCombinations = json_decode($validated['variantCombinationsData'], true);
                foreach ($variants as $variantName => $values) {
                    $variant = Variant::firstOrCreate(['variant' => $variantName]);

                    foreach ($values as $value) {
                        VariantValue::firstOrCreate([
                            'variant_id' => $variant->id,
                            'value' => $value,
                        ]);
                    }
                }

                // Simpan kombinasi varian ke tabel product_variants dan product_details
                foreach ($variantCombinations as $i => $combination) {
                    $productVariant = new ProductVariant([
                        'product_id' => $new_product->id,
                        'stock' => $validated['stock_variant'][$i],
                        'price' => $validated['price_variant'][$i],
                        'weight' => $validated['weight_variant'][$i],
                        'sku' => $validated['sku_variant'][$i],
                        'active' => $validated['active_variant'][$i] ?? false,
                    ]);
                    $productVariant->save();

                    foreach ($combination as $value) {
                        // Misal $value adalah 'Warna: Merah'
                        [$variantName, $variantValue] = explode(': ', $value);
                
                        // Cari variant_id berdasarkan nama varian
                        $variant = Variant::where('variant', $variantName)->first();
                
                        // Cari atau buat VariantValue berdasarkan variant_id dan nilai
                        $variantValueObj = VariantValue::firstOrCreate([
                            'variant_id' => $variant->id,
                            'value' => $variantValue,
                        ]);
                
                        // Simpan ke tabel product_details
                        ProductDetail::create([
                            'product_variant_id' => $productVariant->id,
                            'variant_value_id' => $variantValueObj->id, // Gunakan ID di sini
                            'isMain' => false, // Atur logika isMain sesuai kebutuhan
                        ]);
                    }

                }
            }
        });
        // $variants = json_decode($request->input('variantData'), true);
        // $variantCombinations = json_decode($request->input('variantCombinationsData'), true);

        // // Simpan varian dan nilai varian
        // foreach ($variants as $variantName => $values) {
        //     $variant = Variant::firstOrCreate(['variant' => $variantName]);

        //     foreach ($values as $value) {
        //         $variantValue = VariantValue::firstOrCreate([
        //             'variant_id' => $variant->id,
        //             'value' => $value,
        //         ]);
        //     }
        // }

        // // Simpan kombinasi varian ke tabel product_variants
        // foreach ($variantCombinations as $variantData) {
        //     $productVariant = new ProductVariant([
        //         'stock' => $variantData['stock'],
        //         'price' => $variantData['price'],
        //         'weight' => $variantData['weight'],
        //         'sku' => $variantData['sku'],
        //         'active' => $variantData['active'],
        //     ]);

        //     // $product->productVariants()->save($productVariant);
        // }

        return redirect()->route('product.index')
            ->with('success', 'Berhasil ditambahkan!');
    }

    function show(Product $product)
    {
        $data = $product;

        return view('admin.product.show', compact('data'));
    }

    function edit(Product $product)
    {
        $data = $product->load('detail_value.detail');
        $variants = Variant::limit(2)->get();
        $categories = Category::all();
        $brands = Brand::all();

        $existingVariants = $product->product_variant->mapWithKeys(function($variant) {
            return [$variant->product_detail->first()->variant_value->variant->variant => 
                    $variant->product_detail->pluck('variant_value.value')->toArray()];
        })->toArray();  // Convert to array for JSON encoding
        
        $existingVariantCombinations = $product->product_variant->map(function($variant) {
            return $variant->product_detail->pluck('variant_value.value')->toArray();
        })->toArray();  // Convert to array for JSON encoding

        return view('admin.product.form', compact('data', 'variants', 'categories', 'brands', 'existingVariants', 'existingVariantCombinations'));
    }

    function update(UpdateProductRequest $request, Product $product)
    {
        // dd($request->all());
        $validated = $request->validated();

        $product->name = $validated["name"];
        $product->slug = Str::of($validated["name"])->slug('-')->value;
        $product->description = $validated["description"];

        DB::transaction(function () use ($product, $validated) {
            $product->save();

            // HAPUS DULU PRODUCT VARIAN KEMUDIAN SIMPAN DENGAN YANG BARU (INI JIKA TANPA VARIANT)
            ProductVariant::where('product_id', $product->id)->delete();

            $newProductVariant = new ProductVariant();
            $newProductVariant->product_id = $product->id;
            $newProductVariant->stock = $validated["stock"];
            $newProductVariant->price = $validated["price"];
            $newProductVariant->weight = $validated["weight"];
            $newProductVariant->sku = $validated["sku"];
            $newProductVariant->active = $validated["active"] ?? false;
            $newProductVariant->save();

            // CATEGORIES (many to many)
            if (isset($validated["categories"])) {
                $categoryIds = [];

                foreach ($validated["categories"] as $categoryId) {
                    $category = Category::find($categoryId);

                    if (!$category) {
                        // If the category does not exist, create it with the ID as the name
                        $category = Category::create(['name' => $categoryId]);
                    }

                    $categoryIds[] = $category->id;
                }

                $product->category()->sync($categoryIds);
            }

            // PICTURES
            if (isset($validated["product_pictures"])) {

                // TAMBAH GAMBAR
                foreach ($validated["product_pictures"] as $product_picture) {
                    $filename = $product->slug . '-' . uniqid() . '.webp';
                    $path = $this->picture_folder . $filename;
                    Storage::put($path, file_get_contents($product_picture));

                    $newPicture = new ProductPicture();
                    $newPicture->product_id = $product->id;
                    $newPicture->path = $path;
                    $newPicture->save();
                }
            }

            // HAPUS GAMBAR YANG DIHAPUS CLIENT BERDASARKAN ID JIKA ADA
            if (isset($validated["deleted_pictures"])) {
                $deletedPictures = json_decode($validated['deleted_pictures'], true);
                if (!empty($deletedPictures)) {
                    ProductPicture::destroy($deletedPictures);
                }
            }

            // UPDATE DISCOUNT
            $discount = $validated["discount"];
            if ($discount) {
                $promo = Promo::firstOrNew(['product_id' => $product->id]);
                $promo->discount = $discount;

                // toggle promo based discount
                if ($discount > 0) {
                    $promo->active = true;
                } else {
                    $promo->active = false;
                }

                $promo->save();
            } else {
                // kosongkan diskon jika inputan kosong
                $promo = Promo::firstWhere(['product_id' => $product->id]);
                if ($promo) {
                    $promo->discount = 0;
                    $promo->active = false;
                    $promo->save();
                }
            }

            // DIMENTION
            $dimention = Dimention::firstWhere('product_id', $product->id);
            $dimention->length = $validated["length"];
            $dimention->width = $validated["width"];
            $dimention->height = $validated["height"];
            $dimention->save();

            // DETAILS
            if (isset($validated["detail"])) {
                //AMBIL DETAIL_VALUE SAAT INI UNTUK MENDAPATKAN DATA DETAIL DARI DETAIL_ID
                $currentDetailValue = DetailValue::where('product_id', $product->id)->get();
                $currentDetailIds = $currentDetailValue->pluck('detail_id')->toArray();

                // HAPUS SEMUA DETAIL VALUE
                DetailValue::destroy($currentDetailValue);
                foreach ($validated["detail"] as $index => $detail_input) {
                    if (isset($detail_input)) { //hanya simpan detail yang tidak null
                        $detail = Detail::firstOrCreate(['detail' => $detail_input]);

                        $detail_value = new DetailValue();
                        $detail_value->detail_id = $detail->id;
                        $detail_value->product_id = $product->id;
                        $detail_value->value = $validated["detail-value"][$index];

                        $detail_value->save();
                    }
                }

                // HAPUS DETAIL SAAT INI YANG TIDAK DIGUNAKAN PADA DETAIL VALUE PRODUK YG LAIN
                Detail::whereIn('id', $currentDetailIds)
                    ->whereNotIn('id', function ($q) {
                        $q->select('detail_id')
                            ->from((new DetailValue())->getTable());
                    })->delete();
            }
        });

        return redirect()->route('product.index')
            ->with('success', 'Berhasil diubah!');
    }

    function destroy(Product $product)
    {
        $productPictures = ProductPicture::where('product_id', $product->id)->get();

        if ($productPictures) {
            foreach ($productPictures as $picture) {
                Storage::delete($picture->path);
            }
        }

        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Berhasil dihapus !!');
    }

    function allProducts(Request $request)
    {
        $keyword = $request->query('q');
        $perPage = 10;

        if ($keyword) {
            $products = Product::with(['product_pictures', 'promo', 'auction'])
                ->where('name', 'like', '%' . $keyword . '%')
                ->where('active', 1)
                ->latest()
                ->paginate($perPage);

            if ($request->ajax()) {
                return response()->json([
                    'html' => view('components.client.product-items', compact('products'))->render()
                ]);
            }

            return view('client.product.product-by-keyword', compact('products', 'keyword'));
        }

        $product_data = Setting::where('section_name', 'product')->first();
        $products = Product::with(['product_pictures', 'promo', 'auction'])
            ->where('active', 1)
            ->latest()
            ->paginate($perPage);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.client.product-items', compact('products'))->render()
            ]);
        }

        return view('client.product.index', compact('products', 'product_data'));
    }

    function product($slug): View
    {
        $product = Product::firstWhere('slug', $slug);

        return view('client.product.detail', compact('product'));
    }

    function productsByCategory($category): View
    {
        $products = Product::with(['product_pictures', 'promo', 'auction'])
            ->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            })
            ->where('active', 1)
            // ->limit() // nanti dilimit setelah sudah bisa load more
            ->latest()->get();

        return view('client.product.product-by-category', compact('products', 'category'));
    }

    function productsBySearch(Request $request): View
    {
        $keyword = $request->query('n');
        $products = Product::with(['product_pictures', 'promo', 'auction'])
            ->where('name', 'like', '%' . $keyword . '%')
            ->where('active', 1)
            // ->limit() // nanti dilimit setelah sudah bisa load more
            ->latest()->get();

        return view('client.product.product-by-keyword', compact('products'));
    }
}

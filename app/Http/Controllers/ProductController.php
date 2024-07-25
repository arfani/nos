<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductPicture;
use App\Models\ProductVariant;
use App\Models\Promo;
use App\Models\Variant;
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

        $data = Product::with("product_variant", "promo")->latest();

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

            // dd($item->promo->active);

            return [
                'name' => $item->name,
                'stock' => $stock,
                'price' => $priceFormatted,
                'promo' => $item->promo->active ?? null,
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

        DB::transaction(function () use ($new_product, $validated) {
            $new_product->save();

            $newProductVariant = new ProductVariant();
            $newProductVariant->product_id = $new_product->id;
            $newProductVariant->stock = $validated["stock"];
            $newProductVariant->price = $validated["price"];
            $newProductVariant->weight = $validated["weight"];
            $newProductVariant->sku = $validated["sku"];
            $newProductVariant->active = $validated["active"];
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

            // DISCOUNT
            $discount = $validated["discount"];
            if ($discount > 0) {
                $promo = new Promo();
                $promo->product_id = $new_product->id;
                $promo->discount = $discount;
            }
        });

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
        $data = $product;
        $variants = Variant::limit(2)->get();
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.product.form', compact('data', 'variants', 'categories', 'brands'));
    }

    function update(UpdateProductRequest $request, Product $product)
    {
        // dd($request->all());
        $validated = $request->validated();

        $product->name = $validated["name"];
        $product->slug = Str::of($validated["name"])->slug('-')->value;

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
            $newProductVariant->active = $validated["active"];
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
            $promo = Promo::where('product_id', $product->id)->first();
            $promo->discount = $discount;

            // toggle promo berdasarkan discount
            if ($discount > 0) {
                $promo->active = true;
            } else {
                $promo->active = false;
            }

            $promo->save();
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

    function allProducts(): View
    {
        return view('client.product.index');
    }

    function productById(): View
    {
        return view('client.product.detail');
    }

    function productsByCategory($category): View
    {
        // get prduct where category is $category and then pass to view
        //

        return view('client.product.index');
    }
}

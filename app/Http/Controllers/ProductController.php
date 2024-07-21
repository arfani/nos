<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Variant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    function index(Request $request): View
    {
        $queryParams = [
            'name' => ['string', 'nullable'],
        ];

        $validated = $request->validate($queryParams);

        $data = Product::with("product_variant")->latest();

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

            return [
                'name' => $item->name,
                'stock' => $stock,
                'price' => $priceFormatted,
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

        return view('admin.product.form', compact('variants', 'categories'));
    }

    function store(StoreProductRequest $request)
    {
        // dd($request->validated());
        $validated = $request->validated();

        $newProduct = new Product();
        $newProduct->name = $validated["name"];
        $newProduct->slug = Str::of($validated["name"])->slug('-')->value;

        DB::transaction(function () use ($newProduct, $validated) {
            $newProduct->save();

            $newProductVariant = new ProductVariant();
            $newProductVariant->product_id = $newProduct->id;
            $newProductVariant->stock = $validated["stock"];
            $newProductVariant->price = $validated["price"];
            $newProductVariant->weight = $validated["weight"];
            $newProductVariant->sku = $validated["sku"];
            $newProductVariant->active = $validated["active"];
            $newProductVariant->save();

            // CATEGORIES (many to many)
            if (isset($validated["categories"])) {
                $newProduct->category()->attach($validated["categories"]);
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

        return view('admin.product.form', compact('data', 'variants', 'categories'));
    }

    function update(UpdateProductRequest $request, Product $product)
    {
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
            $product->category()->detach();
            if (isset($validated["categories"])) {
                $product->category()->attach($validated["categories"]);
            }
        });
        
        return redirect()->route('product.index')
            ->with('success', 'Berhasil diubah!');
    }

    function destroy(Product $product)
    {
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

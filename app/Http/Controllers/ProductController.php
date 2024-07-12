<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    function index(Request $request) : View {
        $queryParams = [
            'name' => ['string', 'nullable'],
        ];

        $validated = $request->validate($queryParams);

        $data = Product::latest();

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
            return [
                'name' => $item->name,
                'stock' => $item->stock,
                'price' => 'Rp.' . number_format($item->price, 0, ',', '.'),
                'id' => $item->id,
            ];
        });

        $routeName = 'product';

        return view('admin.product.index', compact('data', 'indexNumber', 'validated', 'numbRows', 'headers', 'rows', 'routeName', 'queryParams'));
    }


    function create() : View{
        return view('admin.product.form');
    }

 function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $validated["slug"] = Str::of($validated["name"])->slug('-')->value;

        Product::create($validated);

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

        return view('admin.product.form', compact('data'));
    }

    function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product->update($validated);

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

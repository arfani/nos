<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index(Request $request):View
    {
        $validated = $request->validate([
            'name' => ['string', 'nullable'],
        ]);

        $data = Brand::latest();

        if (isset($validated["name"])) {
            $data = $data->where('name', 'like', '%' . $validated["name"] . '%');
        }

        $numb_per_page = $request['numb_per_page'] ?? 10;

        $data = $data->paginate($numb_per_page)->appends(array_merge($validated, ['numb_per_page' => $numb_per_page]));
        $indexNumber = (request()->input('page', 1) - 1) * $numb_per_page;

        return view('admin.brand.index', compact('data', 'indexNumber', 'validated', 'numb_per_page'));
    }

    public function create()
    {
        return view('admin.brand.form');
    }

    public function store(StoreBrandRequest $request)
    {
        $validated = $request->validated();

        $newData = Brand::create($validated);

        if (isset($validated["logo"])) {
            $filename = 'brand-' . uniqid() . '.webp';
            $path = 'brands/' . $filename;
            Storage::put($path, file_get_contents($validated["logo"]));

            $newData->logo = $path;
            $newData->save();
        }

        return redirect()->route('brand.index')
            ->with('success', 'Brand berhasil ditambahkan!');
    }

    public function show(Brand $brand)
    {
        $data = $brand;

        return view('admin.brand.show', compact('data'));
    }

    public function edit(Brand $brand)
    {
        $data = $brand;

        return view('admin.brand.form', compact('data'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $validated = $request->validated();

        $brand->name = $validated["name"];
        $brand->link = $validated["link"];

        if (isset($validated["logo"])) {
            // remove old logo
            if(isset($brand->logo)){
                Storage::delete($brand->logo);
            }

            $filename = 'brand-' . uniqid() . '.webp';
            $path = 'brands/' . $filename;
            Storage::put($path, file_get_contents($validated["logo"]));

            $brand->logo = $path;
        }
        
        $brand->save();
        
        return redirect()->route('brand.index')
            ->with('success', 'Berhasil diubah!');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        if (isset($brand->logo)) {
            Storage::delete($brand->logo);
        }

        return redirect()->route('brand.index')
            ->with('success', 'Berhasil dihapus !!');
    }

    function getById(Brand $brand) {
        return $brand;
    }
}

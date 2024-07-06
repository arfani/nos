<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $queryParams = [
            'nama' => ['string', 'nullable'],
        ];

        $validated = $request->validate($queryParams);

        $data = Category::latest();

        if (isset($validated["nama"])) {
            $data = $data->where('name', 'like', '%' . $validated["nama"] . '%');
        }
        // NUMBER OF ROWS PER PAGE
        $numbRows = $request['numbRows'] ?? 10;

        $data = $data->paginate($numbRows)->appends(array_merge($validated, ['numbRows' => $numbRows]));
        $indexNumber = (request()->input('page', 1) - 1) * $numbRows;

        // PERHATIKAN URUTAN $headers dan $rows, INI AKAN MENJADI URUTAN PADA TABEL
        $headers = [
            'No',
            'Nama',
            'Aksi'
        ];

        $rows = $data->map(function ($item) {
            return [
                'name' => $item->name,
                'id' => $item->id,
            ];
        });

        $routeName = 'category';

        return view('admin.category.index', compact('data', 'indexNumber', 'validated', 'numbRows', 'headers', 'rows', 'routeName', 'queryParams'));
    }

    public function create()
    {
        return view('admin.category.form');
    }

    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        Category::create($validated);

        return redirect()->route('category.index')
            ->with('success', 'Berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        $data = $category;

        return view('admin.category.form', compact('data'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $category->update($validated);

        return redirect()->route('category.index')
            ->with('success', 'Berhasil diubah!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')
            ->with('success', 'Berhasil dihapus !!');
    }
}

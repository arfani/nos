<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\CategoryLabel;
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

        $data = Category::with('category_label')->latest();

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
            'Label',
            'Aksi'
        ];

        $rows = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'category_label' => $item->category_label->name,
            ];
        });

        $routeName = 'category';

        return view('admin.category.index', compact('data', 'indexNumber', 'validated', 'numbRows', 'headers', 'rows', 'routeName', 'queryParams'));
    }

    public function create()
    {
        $category_labels = CategoryLabel::pluck('name', 'id')->toArray();
        return view('admin.category.form', compact('category_labels'));
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
        $category_labels = CategoryLabel::pluck('name', 'id')->toArray();
        return view('admin.category.form', compact('data', 'category_labels'));
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

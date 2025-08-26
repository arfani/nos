<?php

namespace App\Http\Controllers;

use App\Models\CategoryLabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryLabelController extends Controller
{
    // endpoint untuk update dropdown category label di form category
    public function index(Request $request)
{
    if ($request->wantsJson()) {
        return CategoryLabel::select('id','name')->get();
    }
}

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:category_labels,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $label = CategoryLabel::create($validator->validated());
        return response()->json($label);
    }

    public function update(Request $request, CategoryLabel $category_label)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:category_labels,name,' . $category_label->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $category_label->update($validator->validated());
        return response()->json($category_label);
    }

    public function destroy(CategoryLabel $category_label)
{
    try {
        $category_label->delete();
        return response()->json(['success' => true]);
    } catch (\Illuminate\Database\QueryException $e) {
        // kode 23000 = integrity constraint violation
        if ($e->getCode() == "23000") {
            return response()->json([
                'success' => false,
                'message' => 'Label tidak bisa dihapus karena masih digunakan oleh kategori.'
            ], 409); // 409 Conflict
        }

        throw $e; // kalau error lain, lempar biar ketahuan
    }
}

}

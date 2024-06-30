<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Models\Feature;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index(Request $request):View
    {
        $validated = $request->validate([
            'name' => ['string', 'nullable'],
        ]);

        $data = Feature::latest();

        if (isset($validated["name"])) {
            $data = $data->where('name', 'like', '%' . $validated["name"] . '%');
        }

        $numb_per_page = $request['numb_per_page'] ?? 10;

        $data = $data->paginate($numb_per_page)->appends(array_merge($validated, ['numb_per_page' => $numb_per_page]));
        $indexNumber = (request()->input('page', 1) - 1) * $numb_per_page;

        return view('admin.feature.index', compact('data', 'indexNumber', 'validated', 'numb_per_page'));
    }

    public function create()
    {
        return view('admin.feature.form');
    }

    public function store(StoreFeatureRequest $request)
    {
        $validated = $request->validated();

        Feature::create($validated);

        return redirect()->route('feature.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Feature $feature)
    {
        $data = $feature;

        return view('admin.feature.form', compact('data'));
    }

    public function update(UpdateFeatureRequest $request, Feature $feature)
    {
        $validated = $request->validated();

        $feature->update($validated);

        return redirect()->route('feature.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();

        return redirect()->route('feature.index')
            ->with('success', 'Berhasil dihapus !!');
    }

    function getById(Feature $feature) {
        return $feature;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
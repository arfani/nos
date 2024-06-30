<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSosmedRequest;
use App\Http\Requests\UpdateSosmedRequest;
use App\Models\Sosmed;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SosmedController extends Controller
{
    public function index(Request $request):View
    {
        $validated = $request->validate([
            'name' => ['string', 'nullable'],
        ]);

        $data = Sosmed::latest();

        if (isset($validated["name"])) {
            $data = $data->where('name', 'like', '%' . $validated["name"] . '%');
        }

        $numb_per_page = $request['numb_per_page'] ?? 10;

        $data = $data->paginate($numb_per_page)->appends(array_merge($validated, ['numb_per_page' => $numb_per_page]));
        $indexNumber = (request()->input('page', 1) - 1) * $numb_per_page;

        return view('admin.sosmed.index', compact('data', 'indexNumber', 'validated', 'numb_per_page'));
    }

    public function create()
    {
        return view('admin.sosmed.form');
    }

    public function store(StoreSosmedRequest $request)
    {
        $validated = $request->validated();

        $newData = Sosmed::create($validated);

        if (isset($validated["logo"])) {
            $filename = 'sosmed-' . uniqid() . '.webp';
            $path = 'somed/' . $filename;
            Storage::put($path, file_get_contents($validated["logo"]));

            $newData->logo = $path;
            $newData->save();
        }

        return redirect()->route('sosmed.index')
            ->with('success', 'Sosmed berhasil ditambahkan!');
    }

    public function show(Sosmed $sosmed)
    {
        $data = $sosmed;

        return view('admin.sosmed.show', compact('data'));
    }

    public function edit(Sosmed $sosmed)
    {
        $data = $sosmed;

        return view('admin.sosmed.form', compact('data'));
    }

    public function update(UpdateSosmedRequest $request, Sosmed $sosmed)
    {
        $validated = $request->validated();

        $sosmed->name = $validated["name"];
        $sosmed->url = $validated["url"];

        if (isset($validated["logo"])) {
            // remove old logo
            if(isset($sosmed->logo)){
                Storage::delete($sosmed->logo);
            }

            $filename = 'sosmed-' . uniqid() . '.webp';
            $path = 'somed/' . $filename;
            Storage::put($path, file_get_contents($validated["logo"]));

            $sosmed->logo = $path;
        }
        
        $sosmed->save();
        
        return redirect()->route('sosmed.index')
            ->with('success', 'Berhasil diubah!');
    }

    public function destroy(Sosmed $sosmed)
    {
        $sosmed->delete();

        if (isset($sosmed->logo)) {
            Storage::delete($sosmed->logo);
        }

        return redirect()->route('sosmed.index')
            ->with('success', 'Berhasil dihapus !!');
    }

    // function getById(Sosmed $sosmed) {
    //     return $sosmed;
    // }
}

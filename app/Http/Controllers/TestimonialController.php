<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index(Request $request):View
    {
        $validated = $request->validate([
            'name' => ['string', 'nullable'],
        ]);

        $data = Testimonial::latest();

        if (isset($validated["name"])) {
            $data = $data->where('name', 'like', '%' . $validated["name"] . '%');
        }

        $numb_per_page = $request['numb_per_page'] ?? 10;

        $data = $data->paginate($numb_per_page)->appends(array_merge($validated, ['numb_per_page' => $numb_per_page]));
        $indexNumber = (request()->input('page', 1) - 1) * $numb_per_page;

        return view('admin.testimonial.index', compact('data', 'indexNumber', 'validated', 'numb_per_page'));
    }

    public function create()
    {
        return view('admin.testimonial.form');
    }

    public function store(StoreTestimonialRequest $request)
    {
        $validated = $request->validated();

        $newData = Testimonial::create($validated);

        if (isset($validated["img"])) {
            $filename = 'testimonial-' . uniqid() . '.webp';
            $path = 'testimonial/' . $filename;
            Storage::put($path, file_get_contents($validated["img"]));

            $newData->img = $path;
            $newData->save();
        }

        return redirect()->route('testimonial.index')
            ->with('success', 'Testimonial berhasil ditambahkan!');
    }

    public function show(Testimonial $testimonial)
    {
        $data = $testimonial;

        return view('admin.testimonial.show', compact('data'));
    }

    public function edit(Testimonial $testimonial)
    {
        $data = $testimonial;

        return view('admin.testimonial.form', compact('data'));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $validated = $request->validated();

        $testimonial->name = $validated["name"];
        $testimonial->message = $validated["message"];
        $testimonial->show = $validated["show"];

        if (isset($validated["img"])) {
            // remove old img
            if(isset($testimonial->img)){
                Storage::delete($testimonial->img);
            }

            $filename = 'testimonial-' . uniqid() . '.webp';
            $path = 'testimonial/' . $filename;
            Storage::put($path, file_get_contents($validated["img"]));

            $testimonial->img = $path;
        }
        
        $testimonial->save();
        
        return redirect()->route('testimonial.index')
            ->with('success', 'Berhasil diubah!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        if (isset($testimonial->img)) {
            Storage::delete($testimonial->img);
        }

        return redirect()->route('testimonial.index')
            ->with('success', 'Berhasil dihapus !!');
    }

}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Models\Faq;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request):View
    {
        $validated = $request->validate([
            'question' => ['string', 'nullable'],
            'answer' => ['string', 'nullable'],
        ]);

        $data = Faq::latest();

        if (isset($validated["question"])) {
            $data = $data->where('question', 'like', '%' . $validated["question"] . '%');
        } elseif (isset($validated["answer"])) {
            $data = $data->where('answer', 'like', '%' . $validated["answer"] . '%');
        }

        $numb_per_page = $request['numb_per_page'] ?? 10;

        $data = $data->paginate($numb_per_page)->appends(array_merge($validated, ['numb_per_page' => $numb_per_page]));
        $indexNumber = (request()->input('page', 1) - 1) * $numb_per_page;

        return view('admin.faq.index', compact('data', 'indexNumber', 'validated', 'numb_per_page'));
    }

    public function create()
    {
        return view('admin.faq.form');
    }

    public function store(StoreFaqRequest $request)
    {
        $validated = $request->validated();

        Faq::create($validated);

        return redirect()->route('faq.index')
            ->with('success', 'Baq berhasil !! ditambahkan!');
    }

    public function show(Faq $faq)
    {
        $data = $faq;

        return view('admin.faq.show', compact('data'));
    }

    public function edit(Faq $faq)
    {
        $data = $faq;

        return view('admin.faq.form', compact('data'));
    }

    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $validated = $request->validated();

        $faq->update($validated);

        return redirect()->route('faq.index')
            ->with('success', 'Baq berhasil !! diubah!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faq.index')
            ->with('success', 'Berhasil dihapus !!');
    }

    function getById(Faq $faq) {
        return $faq;
    }
}

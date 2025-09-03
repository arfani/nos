<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use App\Models\BankAccount;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // atau Imagick

class BankAccountController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'name' => ['string', 'nullable'],
        ]);

        $data = BankAccount::latest();

        if (isset($validated["name"])) {
            $data = $data->where('name', 'like', '%' . $validated["name"] . '%');
        }

        $numb_per_page = $request['numb_per_page'] ?? 10;

        $data = $data->paginate($numb_per_page)->appends(array_merge($validated, ['numb_per_page' => $numb_per_page]));
        $indexNumber = (request()->input('page', 1) - 1) * $numb_per_page;

        return view('admin.bank-account.index', compact('data', 'indexNumber', 'validated', 'numb_per_page'));
    }

    public function create()
    {
        return view('admin.bank-account.form');
    }

    public function store(StoreBankAccountRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = uniqid('bank_') . '.webp';

            // Buat manager pakai driver GD (atau Imagick kalau tersedia)
            $manager = new ImageManager(new Driver());

            // Baca file, convert ke WebP
            $image = $manager->read($file->getRealPath())
                ->toWebp(90);

            // Simpan ke storage (convert ke binary dulu)
            Storage::put('bank-logos/' . $filename, (string) $image);

            $data['logo'] = 'bank-logos/' . $filename;
        }

        BankAccount::create($data);

        return redirect()->route('bank-account.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(BankAccount $bank_account)
    {
        $data = $bank_account;

        return view('admin.bank-account.form', compact('data'));
    }

    public function update(UpdateBankAccountRequest $request, BankAccount $bank_account)
    {
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = uniqid('bank_') . '.webp';

            // Buat manager pakai driver GD (atau Imagick kalau tersedia)
            $manager = new ImageManager(new Driver());

            // Baca file, convert ke WebP
            $image = $manager->read($file->getRealPath())
                ->toWebp(90);

            // Simpan ke storage (convert ke binary dulu)
            Storage::put('bank-logos/' . $filename, (string) $image);

            $validated['logo'] = 'bank-logos/' . $filename;
        }

        $bank_account->update($validated);

        return redirect()->route('bank-account.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy(BankAccount $bank_account)
    {
        $bank_account->delete();

        return redirect()->route('bank-account.index')
            ->with('success', 'Berhasil dihapus !!');
    }

    function getById(BankAccount $bank_account)
    {
        return $bank_account;
    }
}

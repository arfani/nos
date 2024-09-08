<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    function index(Request $request): View
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();

        $validated = $request->validate([
            'name' => ['string', 'nullable'],
        ]);

        $data = Order::where('user_id', auth()->user()->id)->latest();

        if (isset($validated["name"])) {
            $data = $data->where('name', 'like', '%' . $validated["name"] . '%');
        }

        $numb_per_page = $request['numb_per_page'] ?? 10;

        $data = $data->paginate($numb_per_page)->appends(array_merge($validated, ['numb_per_page' => $numb_per_page]));
        $indexNumber = (request()->input('page', 1) - 1) * $numb_per_page;

        return view('client.profile.index', compact('data', 'indexNumber', 'validated', 'numb_per_page'));
        // return view('client.profile.index', compact('orders'));
    }

    function indexAdmin(): View
    {
        return view('admin.profile.index');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UpdateProfileRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return response()->json(['status' => 'profile-updated']);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function update_photo(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        $path = $request->file('photo')->store('profile-photos', 'public');

        // Optionally, delete the old image if exists
        if ($user->img) {
            Storage::delete($user->img);
        }

        $user->img = $path;
        $user->save();

        return response()->json(['imgPath' => Storage::url($path)]);
    }

    function store_address(Request $request)
    {
        $request->validateWithBag('address_store', [
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'noteForCurrier' => ['nullable', 'string'],
            'recipient' => ['required', 'string'],
            'area_id' => ['required', 'string'],
            'hp' => ['required', 'string', 'regex:/^(?:\+62|62|0)8[1-9][0-9]{6,9}$/'],
            'isMain' => ['nullable', 'string'],
        ]);

        $area = Http::withHeaders([
            // 'authorization' => 'biteship_live.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiZHNjIiwidXNlcklkIjoiNjZjN2VlYTc5ZWE1NWYwMDEyZDcyYzIzIiwiaWF0IjoxNzI0NDcxMTYxfQ.J892b7nG4MRPAsHVv7Hz2AqGg-Nsaw1Eof2wAZX9w4w',
            'authorization' => 'biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoidGVzIiwidXNlcklkIjoiNjZjN2VlYTc5ZWE1NWYwMDEyZDcyYzIzIiwiaWF0IjoxNzI0NDY4OTY4fQ.tvttczzzVKaAvNUKFxkH2tBG68FdSLhiw7_7IoBikZE',
            'content-type' => 'application/json',

        ])->get('https://api.biteship.com/v1/maps/areas/' . $request->area_id)->json();

        if (!$area['success']) {
            return redirect()->back()->withErrors(['message' => 'Gagal fetching data area!'])->withInput();
        }

        $area = $area['areas'][0];

        $user_id = auth()->user()->id;

        $address = new Address();
        $address->name = $request->name;
        $address->address = $request->address;
        $address->noteForCurrier = $request->noteForCurrier;
        $address->recipient = $request->recipient;
        $address->hp = $request->hp;
        $address->isMain = $request->isMain ?? false;
        $address->user_id = $user_id;
        $address->area_id = $area["id"];
        $address->area_name = $area["name"];
        $address->province = $area["administrative_division_level_1_name"];
        $address->city = $area["administrative_division_level_2_name"];
        $address->district = $area["administrative_division_level_3_name"];
        $address->postal_code = $area["postal_code"];

        DB::transaction(function () use ($address, $request, $user_id) {
            // JADIKAN ALAMAT YANG LAIN BUKAN UTAMA JIKA DATA YANG BARU INI DIBAUT MENJADI UTAMA
            if ($request->isMain) {
                Address::where('user_id', $user_id)->update(['isMain' => false]);
            }

            $address->save();
        });

        return redirect()->route('client.profile')->with('success', 'Alamat berhasil ditambahkan.');
    }

    function update_address(Request $request, Address $address)
    {
        $request->validateWithBag('address_update', [
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'noteForCurrier' => ['nullable', 'string'],
            'recipient' => ['required', 'string'],
            'hp' => ['required', 'string', 'regex:/^(?:\+62|62|0)8[1-9][0-9]{6,9}$/'],
            'isMain' => ['nullable', 'string'],
        ]);

        $area = Http::withHeaders([
            // 'authorization' => 'biteship_live.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiZHNjIiwidXNlcklkIjoiNjZjN2VlYTc5ZWE1NWYwMDEyZDcyYzIzIiwiaWF0IjoxNzI0NDcxMTYxfQ.J892b7nG4MRPAsHVv7Hz2AqGg-Nsaw1Eof2wAZX9w4w',
            'authorization' => 'biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoidGVzIiwidXNlcklkIjoiNjZjN2VlYTc5ZWE1NWYwMDEyZDcyYzIzIiwiaWF0IjoxNzI0NDY4OTY4fQ.tvttczzzVKaAvNUKFxkH2tBG68FdSLhiw7_7IoBikZE',
            'content-type' => 'application/json',

        ])->get('https://api.biteship.com/v1/maps/areas/' . $request->area_id)->json();

        if (!$area['success']) {
            return redirect()->back()->withErrors(['message' => 'Gagal fetching data area!'])->withInput();
        }

        $area = $area['areas'][0];

        $address->name = $request->name;
        $address->address = $request->address;
        $address->noteForCurrier = $request->noteForCurrier;
        $address->recipient = $request->recipient;
        $address->hp = $request->hp;
        $address->isMain = $request->isMain ?? false;
        $address->area_id = $area["id"];
        $address->area_name = $area["name"];
        $address->province = $area["administrative_division_level_1_name"];
        $address->city = $area["administrative_division_level_2_name"];
        $address->district = $area["administrative_division_level_3_name"];
        $address->postal_code = $area["postal_code"];

        DB::transaction(function () use ($address, $request) {
            // JADIKAN ALAMAT YANG LAIN BUKAN UTAMA JIKA ALAMAT INI DIBAUT MENJADI UTAMA
            if ($request->isMain) {
                Address::where('user_id', $address->user_id)->update(['isMain' => false]);
            }

            $address->save();
        });

        return redirect()->route('client.profile')->with('success', 'Alamat berhasil diubah.');
    }

    function destroy_address(Address $address)
    {
        $address->delete();

        return redirect()->route('client.profile')->with('success', 'Alamat berhasil dihapus.');
    }
}

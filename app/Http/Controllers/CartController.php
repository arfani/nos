<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\BankAccount;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    function index(): View
    {
        return view('client.cart.index');
    }

    function checkout()
    {
        // INI KE HALAMAN CHECKOUT, BELUM ORDER. NANTI UNTUK ORDER ADA DI ORDERCONTROLLER
        $address = Address::where('user_id', auth()->user()->id)
            ->where('isMain', 1)->first();

        if (!$address) {  //jika tidak ada alamat utama maka ambil alamat yg pertama dibuat
            $address = Address::where('user_id', auth()->user()->id)->first();
        }

        // yg ini untuk dropdown
        $addresses = Address::where('user_id', auth()->user()->id)->get();

        if ($addresses->isEmpty()) {
            return redirect()->back()->withErrors(["no_address" => "Data alamat pengiriman tidak ditemukan, silahkan tambahkan data alamat Anda pada menu profile !"]);
        }

        $bank_accounts = BankAccount::all();

        return view('client.cart.checkout', compact('address', 'addresses', 'bank_accounts'));
    }

    function get_data()
    {
        if (!auth()->check()) {
            return response()->json([]);
        }

        $data = Cart::with('user', 'product.product_variant.product_detail.variant_value.variant', 'product_variant.product_detail.variant_value.variant', 'product.dimention', 'product.promo', 'product_variant', 'product.product_pictures')
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->get();

        return response()->json($data);
    }

    function add_to_cart(Request $request)
    {
        $cart = Cart::firstWhere([
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'product_variant_id' => $request->product_variant_id
        ]);

        // JIKA VARIAN ADA MAKA AMBIL VARIANNYA, JIKA TIDAK ADA MAKA AMBIL VARIAN PERTAMA DARI PRODUCT ID
        if ($request->product_variant_id) {
            $product = ProductVariant::find($request->product_variant_id);
        } else {
            $product = ProductVariant::where('product_id', $request->product_id)->first();
        }

        // JIKA ADA CART MAKA TAMBAH QTY PERMINTAAN DARI USER
        $requestQty = $cart ? $cart->quantity + $request->quantity : $request->quantity;
        if ($product->stock < $requestQty) {
            return response()->json(['status' => 0, 'message' => 'Stok tidak mencukupi']);
        }

        // JIKA BARANG SUDAH ADA DI DALAM CART MAKA HANYA AKUMULASI QTY SAJA
        if ($cart) {
            $cart->quantity += $request->quantity;
        } else {
            // JIKA TIDAK ADA BARANG MAKA TAMBAH BARU
            $cart = new Cart();
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $request->product_id;
            $cart->product_variant_id = $request->product_variant_id;
            $cart->quantity = $request->quantity;
        }
        $cart->save();

        return response()->json(['status' => 1]);
    }

    function update_qty(Request $request, Cart $cart)
    {
        // JIKA VARIAN ADA MAKA AMBIL VARIANNYA, JIKA TIDAK ADA MAKA AMBIL VARIAN PERTAMA DARI PRODUCT ID
        if ($cart->product_variant_id) {
            $product = ProductVariant::find($cart->product_variant_id);
        } else {
            $product = ProductVariant::where('product_id', $cart->product_id)->first();
        }

        $requestQty = $request->qty;
        if ($product->stock < $requestQty) {
            return response()->json(['status' => 0, 'message' => 'Stok tidak mencukupi']);
        }

        $cart->quantity = $request->qty;
        $cart->save();

        return response()->json(['status' => 1]);
    }

    function remove_item(Cart $cart)
    {
        // return $cart;
        $cart->delete();

        return response()->json(['status' => 1]);
    }

    function get_areas_single(Request $request)
    {
        $queryParams = $request->query();

        // Build the query string from the parameters
        $queryString = http_build_query($queryParams);

        $response = Http::withHeaders([
            // 'authorization' => 'biteship_live.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiZHNjIiwidXNlcklkIjoiNjZjN2VlYTc5ZWE1NWYwMDEyZDcyYzIzIiwiaWF0IjoxNzI0NDcxMTYxfQ.J892b7nG4MRPAsHVv7Hz2AqGg-Nsaw1Eof2wAZX9w4w',
            'authorization' => 'biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoidGVzIiwidXNlcklkIjoiNjZjN2VlYTc5ZWE1NWYwMDEyZDcyYzIzIiwiaWF0IjoxNzI0NDY4OTY4fQ.tvttczzzVKaAvNUKFxkH2tBG68FdSLhiw7_7IoBikZE',
            'content-type' => 'application/json',

        ])->get('https://api.biteship.com/v1/maps/areas?countries=ID&type=single&' . $queryString);

        return response()->json($response->json());
    }

    function cek_ongkir(Request $request)
    {
        // return 'disable dulu';
        $validated = $request->validate([
            'origin_area_id' => ['required', 'string'],
            'destination_area_id' => ['required', 'string'],
            'couriers' => ['required', 'string'],
            'items' => ['required', 'array']
        ]);


        $response = Http::withHeaders([
            'authorization' => 'biteship_live.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiZHNjIiwidXNlcklkIjoiNjZjN2VlYTc5ZWE1NWYwMDEyZDcyYzIzIiwiaWF0IjoxNzI0NDcxMTYxfQ.J892b7nG4MRPAsHVv7Hz2AqGg-Nsaw1Eof2wAZX9w4w',
            // 'authorization' => 'biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoidGVzIiwidXNlcklkIjoiNjZjN2VlYTc5ZWE1NWYwMDEyZDcyYzIzIiwiaWF0IjoxNzI0NDY4OTY4fQ.tvttczzzVKaAvNUKFxkH2tBG68FdSLhiw7_7IoBikZE',
            'content-type' => 'application/json',
            // DIBAWAH CONTOH CEK ONGKIR / COURIER RATES
        ])->post(
            'https://api.biteship.com/v1/rates/couriers',
            [
                'origin_area_id' => $validated["origin_area_id"],
                "destination_area_id" => $validated["destination_area_id"],
                'couriers' => $validated["couriers"],
                'items' => $validated["items"],
                // item nya hanya bisa satu, jadi sum dy
            ]
        );

        return response()->json($response->json());
    }
}

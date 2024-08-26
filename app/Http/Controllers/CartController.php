<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
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
        // $response = Http::withHeaders([
        //     // 'authorization' => 'biteship_live.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiZHNjIiwidXNlcklkIjoiNjZjN2VlYTc5ZWE1NWYwMDEyZDcyYzIzIiwiaWF0IjoxNzI0NDcxMTYxfQ.J892b7nG4MRPAsHVv7Hz2AqGg-Nsaw1Eof2wAZX9w4w',
        //     'authorization' => 'biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoidGVzIiwidXNlcklkIjoiNjZjN2VlYTc5ZWE1NWYwMDEyZDcyYzIzIiwiaWF0IjoxNzI0NDY4OTY4fQ.tvttczzzVKaAvNUKFxkH2tBG68FdSLhiw7_7IoBikZE',
        //     'content-type' => 'application/json',

        //     ])->get('https://api.biteship.com/v1/maps/areas?countries=ID&input=ja');
        //     // DIBAWAH CONTOH CEK ONGKIR
        // // ])->post(
        // //     'https://api.biteship.com/v1/rates/couriers',
        // //     [
        // //         'origin_postal_code' => 10730,
        // //         'destination_postal_code' => 83239,
        // //         'couriers' => 'gojek,grab,tiki,anteraja,pos,sicepat,jne',
        // //         'items' => [
        // //             [
        // //                 'name' => 'test name barang',
        // //                 'value' => 120000,
        // //                 'quantity' => 3,
        // //                 'weight' => 1000,
        // //             ]
        // //         ],
        // //     ]
        // // );


        // dd($response->json());

        $address = Address::where('user_id', auth()->user()->id)
            ->where('isMain', 1)->first();

        if (!$address) {  //jika tidak ada alamat utama maka ambil alamat yg pertama dibuat
            $address = Address::where('user_id', auth()->user()->id)->first();
        }

        $addresses = Address::where('user_id', auth()->user()->id)->get();

        return view('client.cart.checkout', compact('address', 'addresses'));
    }

    function get_data()
    {
        if (!auth()->check()) {
            return response()->json([]);
        }

        $data = Cart::with('user', 'product.product_variant.product_detail.variant_value.variant', 'product_variant.product_detail.variant_value.variant', 'product.promo', 'product_variant', 'product.product_pictures')
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
}

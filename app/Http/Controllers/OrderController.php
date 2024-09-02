<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function __invoke(Request $request)
    {
        $user_id = auth()->user()->id;

        // BUAT INVOICE
        // Mendapatkan tahun, bulan, dan tanggal saat ini
        $tahun = now()->format("Y");
        $bulan = now()->format("m");
        $tanggal = now()->format("d");

        // MPL (Misalnya, Anda bisa menentukan MPL sesuai dengan kebutuhan)
        $mpl = "DSC";

        // Menghasilkan angka urutan 6 digit (misalnya dari database)
        // Menghitung jumlah total invoice yang sudah ada
        $totalInvoices = Order::count();

        // Menghasilkan nomor invoice baru
        $numbInvoice = $totalInvoices + 1;

        // Menggabungkan semua komponen menjadi string
        $invoice = "PO/{$tahun}{$bulan}{$tanggal}/{$mpl}/" . str_pad($numbInvoice, 6, "0", STR_PAD_LEFT);
        // PO/20240901/CSS/000030

        // tax DSC GA PAKE PAJAK jadi tax dikosongin aja karena default nya null 
        // is_paid kosongin aja karena otomatis false di sql
        // bukti_pembayaran juga diupload nanti setelah order jadi default nya null
        // delivery_state_id default 1 (MENUNGGU KONFIRMASI)

        // SIMAPAN ADDRESS ORDER (DUPLICATE DARI ADDRESS) LALU AMBIL ID NYA
        $address = Address::find($request->orderAddressId);
        // Mengonversi model menjadi array dan menghapus atribut 'id'
        $addressData = collect($address->toArray())->except('id')->toArray();
        // MENGGUNAKAN FIRST OR CREATE BIAR GA TERLALU BANYAK DUPLIKAT, MISAL ADA DATA YANG SAMA MAKA GA BUAT DATA BARU LAGI
        $order_address_id = OrderAddress::firstOrCreate($addressData)->id;
        
        // SHIPPINGMETHOD
        $shipping_method_id = ShippingMethod::firstOrCreate($request->shippingMethod)->id;

        $new_order = new Order();
        $new_order->user_id = $user_id;
        $new_order->invoice = $invoice;
        $new_order->payment_method = $request->paymentMethod;
        $new_order->total = $request->total;
        $new_order->order_address_id = $order_address_id;
        $new_order->shipping_method_id = $shipping_method_id;
        $new_order->save(); 

        return response()->json(["status" => 1, "message" => "Data Order berhasil dibuat", $new_order]);
    }
}

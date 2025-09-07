<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\DeliveryState;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderDetail;
use App\Models\ProductVariant;
use App\Models\ShippingMethod;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

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

        if (gettype($request->shippingMethod) == 'string') {
            // kalo string berarti shipping method nya manual set shipping_method_id = null then isi shipping_method_manual
            $shipping_method_id = null;
            $shipping_method_manual = $request->shippingMethod;
        } else {
            // SHIPPINGMETHOD
            $shippingMethodData = collect($request->shippingMethod)->except(['currency', 'tax_lines'])->toArray();
            $shipping_method_id = ShippingMethod::firstOrCreate($shippingMethodData)->id;

            // ADA PERUBAHAN COLUMN2 DARI BITESHIP NYA, NANTI KALO ADA ERROR KARENA KOLOM SHIPPING METHOD NYA GA COCOK PAKE KODE DIBAWAH INI AJA BUAT GANTI KODE "// SHIPPINGMETHOD" DI ATAS
            // SEMENTARA PAKE KODE "SHIPPINGMETHOD" DI ATAS DULU BUAT TAU APA AJA METHOD YG DITAMBAH BITESHIP NYA
            // $allowedColumns = Schema::getColumnListing('shipping_methods');

            // $shippingMethodData = collect($request->shippingMethod)
            //     ->only($allowedColumns) // hanya ambil key yang memang ada di tabel
            //     ->toArray();
            // $shipping_method_id = ShippingMethod::firstOrCreate($shippingMethodData)->id;
        }

        $new_order = new Order();
        $new_order->user_id = $user_id;
        $new_order->invoice = $invoice;
        $new_order->payment_method = $request->paymentMethod;
        $new_order->total = $request->total;
        $new_order->order_address_id = $order_address_id;
        $new_order->shipping_method_id = $shipping_method_id;
        $new_order->shipping_method_manual = $shipping_method_manual;
        $new_order->bank_account_id = $request->bankAccountId;

        if ($request->paymentMethod == 'Cash') {
            $new_order->delivery_state_id = 2; //Jika Cash set status langsung 'Menunggu Konfirmasi', jika tidak maka defaultnya 'menunggu pembayaran'
        }

        DB::transaction(function () use ($new_order) {
            $new_order->save();

            $carts = Cart::where('user_id', auth()->user()->id)->get();

            foreach ($carts as $cart) {
                $order_detail = new OrderDetail();
                $order_detail->order_id = $new_order->id;
                $order_detail->product_id = $cart->product_id;
                $order_detail->product_variant_id = $cart->product_variant_id;
                $order_detail->quantity = $cart->quantity;
                $order_detail->price = $cart->product_variant ? $cart->product_variant->price : $cart->product->product_variant->first()->price; // jika tidak ada variant maka ambil harga dari relasi product kemudian ambil dari product variant index pertama 
                $order_detail->discount = $cart->product->promo ? $cart->product->promo->discount : 0;
                $order_detail->save();

                // KURANGI STOK SETELAH ORDER / CO
                $product_variant = ProductVariant::find($cart->product_variant ? $cart->product_variant->id : $cart->product->product_variant->first()->id);
                $product_variant->stock -= $cart->quantity;
                $product_variant->save();

                $cart->delete(); // delete cart item
            }
        });

        return response()->json(["status" => 1, "message" => "Order berhasil dibuat", $new_order]);
    }

    function order_by_id(Order $order)
    {
        $order->load(['delivery_state', 'order_address', 'shipping_method', 'order_detail.product', 'order_detail.product_variant.product_detail.variant_value.variant', 'bank_account']);

        return response()->json($order);
    }

    function upload_bukti_bayar(Request $request, Order $order)
    {
        $validated = $request->validate([
            "bukti_bayar" => ["required"]
        ]);

        if (isset($validated["bukti_bayar"])) {
            // remove old
            if (isset($order->bukti_pembayaran)) {
                Storage::delete($order->bukti_pembayaran);
            }

            $filename = 'bukti_bayar-' . uniqid() . '.webp';
            $path = 'bukti-bayar/' . $filename;
            Storage::put($path, file_get_contents($validated["bukti_bayar"]));

            $order->bukti_pembayaran = $path;
        }

        $order->delivery_state_id += 1;
        $order->save();

        return redirect()->route('client.profile')
            ->with('success', 'Berhasil upload bukti bayar!');
    }

    function download_invoice(Order $order)
    {
        $pdf = Pdf::loadView('pdf.invoice', compact('order'));

        return $pdf->stream('invoice-' . $order->id . '.pdf');
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }

    // FOR ADMIN ROUTE
    public function index(Request $request)
    {
        $validated = $request->validate([
            'invoice'            => ['string', 'nullable'],
            'member'             => ['string', 'nullable'],
            'search_by'          => ['string', 'nullable', 'in:invoice,member'],
            'delivery_state_id'  => ['nullable', 'integer', 'exists:delivery_states,id'],
            'date_from'          => ['nullable', 'date'],
            'date_to'            => ['nullable', 'date'],
        ]);

        $data = Order::with(['order_address', 'delivery_state', 'shipping_method', 'user', 'bank_account'])->latest();

        // 🔎 filter invoice
        if (($validated['search_by'] ?? null) === 'invoice' && !empty($validated['invoice'])) {
            $data = $data->where('invoice', 'like', '%' . $validated['invoice'] . '%');
        }

        // 🔎 filter member
        if (($validated['search_by'] ?? null) === 'member' && !empty($validated['member'])) {
            $data = $data->whereHas('user', function ($q) use ($validated) {
                $q->where('name', 'like', '%' . $validated['member'] . '%');
            });
        }

        // 🔎 filter status
        if (!empty($validated['delivery_state_id'])) {
            $data = $data->where('delivery_state_id', $validated['delivery_state_id']);
        }

        // 🔎 filter tanggal
        if (!empty($validated['date_from']) && !empty($validated['date_to'])) {
            $data = $data->whereBetween('created_at', [
                $validated['date_from'] . ' 00:00:00',
                $validated['date_to'] . ' 23:59:59'
            ]);
        } elseif (!empty($validated['date_from'])) {
            $data = $data->whereDate('created_at', '>=', $validated['date_from']);
        } elseif (!empty($validated['date_to'])) {
            $data = $data->whereDate('created_at', '<=', $validated['date_to']);
        }

        // jumlah per halaman
        $numb_per_page = $request->input('numb_per_page', 10);

        $data = $data->paginate($numb_per_page)->appends(array_merge($validated, [
            'numb_per_page' => $numb_per_page,
        ]));

        $indexNumber = (request()->input('page', 1) - 1) * $numb_per_page;

        $delivery_states = \App\Models\DeliveryState::pluck('name', 'id');

        return view('admin.order.index', compact(
            'data',
            'indexNumber',
            'validated',
            'numb_per_page',
            'delivery_states'
        ));
    }

    function show(Order $order)
    {
        $data = $order->load(['delivery_state', 'order_address', 'shipping_method', 'order_detail.product', 'order_detail.product_variant.product_detail.variant_value.variant']);

        // dd($data);
        return view('admin.order.show', compact('data'));
    }

    function next_state(Order $order)
    {
        $order->delivery_state_id += 1;

        if ($order->delivery_state_id == 3) {
            $order->is_paid = true;
        }
        $order->save();

        return redirect()->back()->with('success', 'Berhasil update status menjadi ' . $order->delivery_state->name);
    }

    function cancel(Order $order)
    {
        if ($order->delivery_state_id == DeliveryState::where('name', 'Dibatalkan')->first()->id) {
            return redirect()->back()->with('error', 'Order sudah dibatalkan sebelumnya');
        }


        if ($order->delivery_state_id == DeliveryState::where('name', 'Selesai')->first()->id) {
            return redirect()->back()->with('error', 'Order sudah selesai tidak bisa dibatalkan');
        }

        $order->delivery_state_id = DeliveryState::where('name', 'Dibatalkan')->first()->id;
        $order->save();

        // KEMBALIKAN STOK
        foreach ($order->order_detail as $detail) {
            $product_variant = ProductVariant::find($detail->product_variant ? $detail->product_variant->id : $detail->product->product_variant->first()->id);
            $product_variant->stock += $detail->quantity;
            $product_variant->save();
        }

        return redirect()->back()->with('success', 'Berhasil membatalkan order dan mengembalikan stok produk');
    }
}

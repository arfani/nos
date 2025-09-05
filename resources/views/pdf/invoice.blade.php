<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INVOICE | DSComputer</title>
    <style>
        .header-container {
            /* background-color: red; */
        }

        .logo {
            display: inline-block;
        }

        .logo img {
            width: 100px;
            /* height: 120px; */
        }

        .invoice {
            position: fixed;
            top: 0;
            right: 0;
            text-align: right;
        }

        .invoice .title {
            font-size: 18;
            font-weight: bold;
        }

        .invoice .no {
            color: green;
        }

        .invoice div {
            display: inline-block;
        }

        .table-1 {
            width: 100%;
        }

        .penjual {
            white-space: nowrap;
            padding-right: 50px;
        }

        .table-2 {
            width: 100%;
            margin-top: 25px;
        }

        .table-2 .header {
            /* border-style: solid;
            border-top-width: 1px;
            border-top-color: black; */

            text-align: center;
            margin-bottom: 10px;
            background-color: #aaa;
            color: #000;
            font-weight: bold;
        }

        .table-3 {
            width: 60%;
            margin-top: 15px;
            margin-left: auto;
        }

        .table-4 {
            width: 100%;
            margin-top: 25px;
        }

        .table-4 td {
            width: 50%;
        }
    </style>
</head>

<body>
    <div class="header-container">
        <div class="logo">
            <img src="storage/logo.webp" alt="Logo">
        </div>
        <div class="invoice">
            <div class="title">
                Purchase Order
            </div>
            <br>
            <div class="no">
                {{ $order->invoice }}
            </div>
        </div>
    </div>

    <table class="table-1">
        <tr>
            <td style="width: 300px;">DITERBITKAN ATAS NAMA</td>
            <td>UNTUK</td>
            <td></td>
        </tr>
        <tr>
            <td class="penjual">Penjual : DS Computer</td>
            <td style="white-space: nowrap;">
                Nama
            </td>
            <td>:</td>
            <td>
                <span style="font-weight: bold">{{ $order->order_address->recipient }}</span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="white-space: nowrap;">
                Tanggal Pembelian
            </td>
            <td>:</td>
            <td>
                <span style="font-weight: bold">{{ $order->created_at->isoFormat('dddd, DD MMMM YYYY') }}</span>
            </td>
        </tr>
        <tr>
            {{-- <td>status : <strong>{{$order->isPaid ? 'PAID' : 'UNPAID'}}</strong></td> --}}
            <td></td>
            <td style="white-space: nowrap; vertical-align:top;">
                Alamat Pengiriman
            </td>
            <td style="vertical-align:top;">:</td>
            <td>
                <div>{{ $order->order_address->address }}</div>
                <div>{{ $order->order_address->area_name }}</div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="white-space: nowrap; vertical-align:top;">
                Telp / WA
            </td>
            <td>:</td>
            <td>
                <span>{{ $order->order_address->hp }}</span>
            </td>
        </tr>
    </table>

    <table class="table-2">
        <tr class="header">
            <td>PRODUK</td>
            <td>JUMLAH</td>
            <td>HARGA SATUAN</td>
            <td>DISKON</td>
            <td>TOTAL HARGA</td>
        </tr>
        @php
            $totalBayar = 0; // Inisialisasi total bayar
            $totalQty = 0; // Inisialisasi total bayar
        @endphp

        @foreach ($order->order_detail as $key => $orderDetail)
            @php
                // Menghitung subtotal sebelum diskon
                $subtotal = $orderDetail->price * $orderDetail->quantity;

                // Cek jika ada diskon, misal diskon berupa persentase
                $discount = isset($orderDetail->discount) ? $orderDetail->discount : 0;
                $discountAmount = $discount > 0 ? $subtotal * ($discount / 100) : 0;

                // Subtotal setelah diskon
                $subtotalAfterDiscount = $subtotal - $discountAmount;

                // Tambahkan ke total bayar
                $totalBayar += $subtotalAfterDiscount;

                // akumulasi qty
                $totalQty += $orderDetail->quantity;
            @endphp
            <tr>
                <td>
                    @if ($orderDetail->product_variant)
                        <span>
                            {{ $orderDetail->product->name }}
                            <br />
                            <span>(
                                @foreach ($orderDetail->product_variant->product_detail as $index => $detail)
                                    <span>
                                        {{ $detail->variant_value->variant->variant }} -
                                        {{ $detail->variant_value->value }}
                                        @if ($index < $orderDetail->product_variant->product_detail->count() - 1)
                                            ,
                                        @endif
                                    </span>
                                @endforeach
                                )
                            </span>
                        </span>
                    @else
                        <span>{{ $orderDetail->product->name }}</span>
                    @endif
                </td>
                <td style="text-align:center;">{{ $orderDetail->quantity }}</td>
                <td style="text-align:center;">{{ number_format($orderDetail->price, 0, ',', '.') }}</td>
                <td style="text-align:center;">
                    {{-- Tampilkan diskon jika ada --}}
                    @if ($discount > 0)
                        {{ number_format($discountAmount, 0, ',', '.') }} ({{ $discount }}%)
                    @else
                        -
                    @endif
                </td>
                <td style="text-align:center;">{{ number_format($subtotalAfterDiscount, 0, ',', '.') }}</td>

            </tr>
        @endforeach

    </table>


    <table class="table-3">
        <tr>
            <td>TOTAL HARGA ({{ $totalQty . ' PRODUK' }})</td>
            <td style="font-weight: bold; text-align:right">{{ 'Rp. ' . number_format($totalBayar, 0, ',', '.') }}</td>
        </tr>
        {{-- <tr>
            <td>PPN 11%</td>
            <td style="font-weight: bold; text-align:right">{{'Rp. '.number_format(100000 * (11/100), 0, ',',
                '.')}}</td>
        </tr> --}}
        <tr>
            <td>TOTAL BAYAR</td>
            <td style="font-weight: bold; text-align:right">{{ 'Rp. ' . number_format($totalBayar, 0, ',', '.') }}</td>
        </tr>
    </table>

    <table class="table-4">
        <tr>
            <td>Kurir:</td>
            <td>Metode Pembayaran:</td>
        </tr>
        <tr>
            <td>{{ $order->shipping_method->courier_name . ' - ' . $order->shipping_method->courier_service_name }}
            </td>
            <td>{{ $order->payment_method }}</td>
        </tr>
    </table>

</body>

</html>

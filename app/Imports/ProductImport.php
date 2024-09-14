<?php

namespace App\Imports;

use App\Models\Detail;
use App\Models\DetailValue;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ProductImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $i => $row) {
            if ($i === 0 || !isset($row['nama_produk'])) {
                continue;
            }
            // dd($row['nama_produk']);
            $product = new Product();

            $product->name = $row['nama_produk'];
            $product->slug = Str::of($row['nama_produk'])->slug('-')->value;
            $product->description = $row['deskripsi_produk'];

            DB::transaction(function () use ($product, $row) {
                $product->save();

                $newProductVariant = new ProductVariant();
                $newProductVariant->product_id = $product->id;
                $newProductVariant->stock = $row["jumlah_stok"];
                $newProductVariant->price = $row["harga_rp"];
                $newProductVariant->weight = $row["berat_gram"];
                $newProductVariant->sku = $row["sku_name"];
                $newProductVariant->active = $row["status"] === 'Aktif' ? true : false;
                $newProductVariant->save();


                $detail = Detail::firstOrCreate(['detail' => "Minimum Pemesanan"]);

                $detail_value = new DetailValue();
                $detail_value->detail_id = $detail->id;
                $detail_value->product_id = $product->id;
                $detail_value->value = $row["minimum_pemesanan"];

                $detail_value->save();

                $detail = Detail::firstOrCreate(['detail' => "Kondisi"]);

                $detail_value = new DetailValue();
                $detail_value->detail_id = $detail->id;
                $detail_value->product_id = $product->id;
                $detail_value->value = $row["kondisi"];

                $detail_value->save();
            });
        }
    }

    public function headingRow(): int
    {
        return 2;
    }
}

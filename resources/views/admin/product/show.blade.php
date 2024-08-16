<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-base-200 text-base-content overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 [&>div]:mb-2">
                <h2 class="text-2xl uppercase mb-4">Data <b>{{ $data->name }}</b></h2>
                <div class="flex md:flex-row flex-col gap-4">
                    <div class="flex-1">
                        <div>Nama : <strong>{{ $data->name }}</strong></div>
                        <div>Brand : <strong>{{ $data->brand->name ?? '-' }}</strong></div>
                        @if (count($data->product_variant) <= 1)
                            <div>Stok : <strong>{{ $data->product_variant->first()->stock }}</strong></div>
                            <div>Harga : <strong><x-client.format-rp :value="$data->product_variant->first()->price" /></strong></div>
                            <div>Berat : <strong>{{ $data->product_variant->first()->weight }} g</strong></div>
                            <div>SKU : <strong>{{ $data->product_variant->first()->sku }}</strong></div>
                            <div>Status : <strong>{{ $data->active ? 'Aktif' : 'Tidak Aktif' }}</strong></div>
                        @endif
                        <div>Diskon : <strong>{{ $data->promo->discount ?? 0 }} %</strong></div>
                        <div>Panjang : <strong>{{ $data->dimention->length }} cm</strong></div>
                        <div>Lebar : <strong>{{ $data->dimention->width }} cm</strong></div>
                        <div>Tinggi : <strong>{{ $data->dimention->height }} cm</strong></div>
                        <div>Deskripsi : <strong>{!! $data->description !!}</strong></div>
                        @if (count($data->product_variant) > 1)
                            <div class="overflow-auto"> Varian :
                                <table class="w-full table-auto bg-base-300 text-base-content shadow-md rounded-lg mt-2">
                                    <thead>
                                        <tr class="bg-secondary text-secondary-content uppercase text-sm leading-normal">
                                            @foreach ($data->product_variant->first()->product_detail as $detail)
                                                <th class="py-3 px-4 text-left">
                                                    {{ $detail->variant_value->variant->variant }}</th>
                                            @endforeach
                                            <th class="py-3 px-4 text-left">Stok</th>
                                            <th class="py-3 px-4 text-left">Harga</th>
                                            <th class="py-3 px-4 text-left">Berat</th>
                                            <th class="py-3 px-4 text-left">SKU</th>
                                            <th class="py-3 px-4 text-left">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm font-light">
                                        @foreach ($data->product_variant as $variant)
                                            <tr class="border-b">
                                                @foreach ($variant->product_detail as $detail)
                                                    <td class="py-3 px-4 text-left whitespace-nowrap">
                                                        {{ $detail->variant_value->value }}</td>
                                                @endforeach
                                                <td class="py-3 px-4 text-left">{{ $variant->stock }}</td>
                                                <td class="py-3 px-4 text-left">
                                                    {{ number_format($variant->price, 0, ',', '.') }} IDR</td>
                                                <td class="py-3 px-4 text-left">{{ $variant->weight }} g</td>
                                                <td class="py-3 px-4 text-left">{{ $variant->SKU }}</td>
                                                <td class="py-3 px-4 text-left">
                                                    <span
                                                        class="px-2 py-1 whitespace-nowrap font-semibold leading-tight {{ $variant->active ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }} rounded-full">
                                                        {{ $variant->active ? 'Aktif' : 'Tidak Aktif' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        @endif
                    </div>
                </div>
                <div class="flex-1 flex flex-col gap-2">
                    <div>Gambar :
                        <div class="flex flex-wrap gap-2 [&>img]:rounded mt-2">
                            @foreach ($data->product_pictures as $picture)
                                <img src="{{ Storage::url($picture->path) }}" alt="product's image" width="100">
                            @endforeach
                        </div>
                    </div>
                    <div>Video : <strong>{{ $data->youtube ?? '-' }}</strong></div>
                    <div>Kategori :
                        <strong>
                            <ul class="list-disc list-inside">
                                @foreach ($data->category as $category)
                                    <li>{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        </strong>
                    </div>
                </div>
            </div>

            <a href="{{ route('product.index') }}"
                class="py-2 px-4 bg-secondary text-secondary-content text-center mt-6 rounded inline-block">{{ __('Kembali') }}</a>
        </div>
    </div>
    </div>
</x-app-layout>

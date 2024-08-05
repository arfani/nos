<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-base-200 text-base-content overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 [&>div]:mb-2">
                <h2 class="text-2xl uppercase mb-4">Data <b>{{ $data->name }}</b></h2>

                <div class="flex">
                    <div class="flex-1">
                        <div>Nama : <strong>{{ $data->name }}</strong></div>
                        <div>Stok : <strong>{{ $data->product_variant->first()->stock }}</strong></div>
                        <div>Harga : <strong><x-client.format-rp :value="$data->product_variant->first()->price" /></strong></div>
                        <div>Diskon : <strong>{{ $data->promo->discount ?? 0 }} %</strong></div>
                        <div>SKU : <strong>{{ $data->product_variant->first()->sku }}</strong></div>
                        <div>Brand : <strong>{{ $data->brand->name ?? '-' }}</strong></div>
                        <div>Berat : <strong>{{ $data->product_variant->first()->weight }} g</strong></div>
                        <div>Panjang : <strong>{{ $data->dimention->length }} cm</strong></div>
                        <div>Lebar : <strong>{{ $data->dimention->width }} cm</strong></div>
                        <div>Tinggi : <strong>{{ $data->dimention->height }} cm</strong></div>
                        <div>Status : <strong>{{ $data->active ? 'Aktif' : 'Tidak Aktif' }}</strong></div>
                        <div>Deskripsi : <strong>{{ $data->description }}</strong></div>
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

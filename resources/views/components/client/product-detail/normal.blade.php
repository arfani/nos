<x-client.product-detail.thumbnail-picture :product="$product" />

<div
    class="detail-product-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto md:flex-1 mb-6">
    <h1 class="text-center text-xl sm:text-2xl font-bold">
        {{ $product->name }}
    </h1>

    <div class="divider">
        Harga
    </div>

    <x-client.format-rp :value="$product->product_variant->first()->price" />

    @if ($product['variants'])
        <div class="divider">Varian</div>
        <div class="variant mb-1">
            <span class="variant-item">Warna</span> :
            <select class="select" name="warna">
                <option value="putih">putih</option>
                <option value="merah">merah</option>
                <option value="hijau">hijau</option>
            </select>
        </div>
        <div class="variant">
            <span class="variant-item">Ukuran</span> :
            <select class="select" name="ukuran">
                <option value="m">M</option>
                <option value="l" selected>L</option>
                <option value="xl">XL</option>
            </select>
        </div>
    @endif

    @if ($product->detail_value->isNotEmpty())
        <div class="divider">Spesifikasi</div>
        @foreach ($product->detail_value as $detail)
            <div class="specification">
                <span>{{ $detail->detail->detail }}</span> : <span>{{ $detail->value }}</span>
            </div>
        @endforeach
    @endif

    @if ($product->dimention)
        <div class="divider">Dimensi</div>
            <div class="dimention">
                <div><span>Panjang</span> : <span>{{ $product->dimention->length }} cm</span></div>
                <div><span>Lebar</span> : <span>{{ $product->dimention->width }} cm</span></div>
                <div><span>Tinggi</span> : <span>{{ $product->dimention->height }} cm</span></div>
            </div>
    @endif

    <div class="divider">Deskripsi</div>
    <p>{!! $product->description ?? '-' !!}</p>
</div>

<div
    class="action-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto md:mx-0 md:ml-auto lg:w-1/4 mb-6">
    <h1>Atur jumlah dan catatan</h1>
    <div class="divider"></div>
    <input type="number" min="1" value="1" class="input w-20 mb-2">
    <div>Sisa stok : {{ $product->product_variant->first()->stock }}</div>
    <input type="text" class="input w-11/12 my-2" placeholder="Catatan">
    <div class="mb-2">Subtotal : <span>-</span></div>
    <div class="flex justify-center gap-3 mt-4">
        <div class="tooltip" data-tip="Bagikan">
            <button class="btn btn-ghost btn-sm text-lg" x-data
                @click.prevent="$dispatch('open-modal', 'share-product')"><i class="fa fa-share-nodes"></i>
            </button>
        </div>
        {{-- <button class="btn btn-ghost btn-sm text-lg text-secondary"><i class="fa fa-heart-circle-plus"></i></button> --}}
        <button class="btn btn-ghost btn-sm text-lg "><i class="fa fa-opencart"></i></button>
    </div>
</div>

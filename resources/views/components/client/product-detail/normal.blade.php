<x-client.product-detail.thumbnail-picture :product="$product" />

<div
    class="detail-product-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto md:flex-1 mb-6">
    <h1 class="text-center text-xl sm:text-2xl font-bold">
        {{ $product->name }}
    </h1>

    <div class="divider">
        Harga
    </div>

    <span x-ref="priceEl">{{'Rp. ' . number_format($product->product_variant->first()->price, 0, ',', '.')}}</span>

    {{-- MENGGUNKAN KONDISI JIKA PRODUCT_VARIANT > 1 KARENA PRODUK YANG TIDAK MEMILIKI VARIANT MEMILIKI 1 SAJA DATA DI
    TABEL PRODUCT VARIANT SEDANGKAN YANG MEMILIKI VARIANT AKAN MEMILIKI LEBIH DARI 1 DATA --}}
    @if (count($product->product_variant) > 1)
    <x-client.product-detail.variant :product="$product" />
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
    <input type="number" min="1" value="1" class="input w-20 mb-2" x-ref="quantity" @change="
            let originalPrice = {{$product->product_variant->first()->price}};
            if ($refs.subtotal) {
                $refs.subtotal.innerHTML = 'Rp. ' + new Intl.NumberFormat('id-ID', { style: 'decimal', minimumFractionDigits: 0 }).format(originalPrice * $refs.quantity.value);
            }
            " x-init="
            let originalPrice = {{$product->product_variant->first()->price}};
            console.log(originalPrice)
            if ($refs.subtotal) {
                $refs.subtotal.innerHTML = 'Rp. ' + new Intl.NumberFormat('id-ID', { style: 'decimal', minimumFractionDigits: 0 }).format(originalPrice * $refs.quantity.value);
            }
            ">

    <div>Sisa stok : <span x-ref="stock">{{ $product->product_variant->first()->stock }}</span></div>
    <input type="text" class="input w-11/12 my-2" placeholder="Catatan">
    <div class="mb-2" x-ref="subtotal"></div>
    <div class="flex justify-center gap-3 mt-4">
        <div class="tooltip" data-tip="Bagikan">
            <button class="btn btn-ghost btn-sm text-lg" x-data
                @click.prevent="$dispatch('open-modal', 'share-product')"><i class="fa fa-share-nodes"></i>
            </button>
        </div>
        {{-- <button class="btn btn-ghost btn-sm text-lg text-secondary"><i
                class="fa fa-heart-circle-plus"></i></button> --}}
        <button class="btn btn-ghost btn-sm text-lg"
            @click="$store.cart.addToCart('{{ $product->id }}', $refs.variant_id_selected ? $refs.variant_id_selected.value : null, $refs.quantity.value)"><i
                class="fa fa-opencart"></i></button>
    </div>
</div>
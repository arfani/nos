<x-client.product-detail.thumbnail-picture :product="$product" />

<div
    class="detail-product-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto md:flex-1 mb-6">
    <h1 class="text-center text-xl sm:text-2xl font-bold">
        {{ $product->name }}
        ( <span class="animate-pulse">PROMO !!!</span> )
    </h1>

    @if ($product->dimention)
    <div class="divider">Dimensi</div>
    <div class="dimention">
        <div><span>Panjang</span> : <span>{{ $product->dimention->length }} cm</span></div>
        <div><span>Lebar</span> : <span>{{ $product->dimention->width }} cm</span></div>
        <div><span>Tinggi</span> : <span>{{ $product->dimention->height }} cm</span></div>
    </div>
    @endif

    <div class="divider">Deskripsi</div>
    <p>{!! $product->description !!}</p>

    <div class="divider">
        Harga <i class="fa fa-tags text-red-500 text-2xl"></i>
    </div>

    <span class="line-through">
        <span x-ref="priceEl"></span>
    </span>
    <span class="text-xs align-top ml-2">-{{ $product->promo->discount }}%</span>
    <br />
    <span x-ref="priceAfterDiscountEl"></span>

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
</div>

<div
    class="action-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto md:mx-0 md:ml-auto lg:w-1/4 mb-6">
    <h1>Atur jumlah dan catatan</h1>
    <div class="divider"></div>
    <input type="number" min="1" value="1" class="input w-20 mb-2" x-ref="quantity" @change="
            let selectedOption = $refs.variant_id_selected.options[$refs.variant_id_selected.selectedIndex];
            let originalPrice = parseFloat(selectedOption.getAttribute('data-price'));
            let discount = {{ $product->promo->discount ?? 0 }};
            let discountedPrice = originalPrice - (originalPrice * discount / 100);

            if ($refs.subtotal) {
                $refs.subtotal.innerHTML = 'Rp. ' + new Intl.NumberFormat('id-ID', { style: 'decimal', minimumFractionDigits: 0 }).format(discountedPrice * $refs.quantity.value);
            }
            ">

    <div>Sisa stok : <span x-ref="stock">{{ $product->stock }}</span></div>
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
            @click="$store.cart.addToCart('{{ $product->id }}', $refs.variant_id_selected ? $refs.variant_id_selected.value : null, $refs.quantity.value)"
            ><i class="fa fa-opencart"></i></button>
    </div>
</div>
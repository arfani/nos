<div class="card w-72 bg-base-200 shadow-xl mb-8">
    <figure class="px-10 pt-10 relative">
        <a href="{{ route('client.product', $product['slug']) }}">
            <img src="{{ Storage::url($product->product_pictures->first()->path) }}" alt="{{ $product->name }}"
                class="rounded-xl" />
        </a>

        @if (isset($product->auction) && $product->auction->active)
            <x-client.logo-lelang :endtime="$product->auction->endtime" />
        @elseif (isset($product->promo) && $product->promo->active)
            <x-client.logo-promo />
        @endif
    </figure>
    <div class="card-body items-center text-center">
        <a href="{{ route('client.product', $product['slug']) }}">
            <h2 class="card-title">{{ $product->name }}</h2>
        </a>
        <p>{{ $product->description }}</p>
        <div class="card-actions">
            <div class="flex items-center gap-4">
                @if (count($product->product_variant) > 1)
                <x-client.format-rp :value="$product->product_variant[0]->price" /> - <x-client.format-rp :value="$product->product_variant[count($product->product_variant) - 1]->price" />
                    @else
                <x-client.format-rp :value="$product->product_variant[0]->price" />
                @endif
                <div class="tooltip tooltip-bottom" data-tip="Tambah ke keranjang">
                    <button class="btn btn-circle btn-ghost"><i class="fa fa-opencart"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

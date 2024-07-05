<div class="card w-72 bg-base-200 shadow-xl mb-8">
    <figure class="px-10 pt-10 relative">
        <a href="{{ route('client.product', $product["slug"]) }}">
            <img src="{{ $product["img"] }}" alt="Shoes" class="rounded-xl" />
        </a>

        @if ($product["lelang"]["active"])
            <x-client.logo-lelang :endtime='$product["lelang"]["endtime"]' />
        @else
            @if ($product["promo"]["active"])
                <x-client.logo-promo />
            @endif
        @endif
    </figure>
    <div class="card-body items-center text-center">
        <h2 class="card-title">Shoes!</h2>
        <p>If a dog chews shoes whose shoes does he choose?</p>
        <div class="card-actions">
            <div class="flex items-center gap-4">
                <x-client.format-rp :value="$product['price']" />
                <div class="tooltip tooltip-bottom" data-tip="Tambah ke keranjang">
                    <button class="btn btn-circle btn-ghost"><i class="fa fa-opencart"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

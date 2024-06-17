<div class="card w-72 bg-base-200 shadow-xl mb-8">
    <figure class="px-10 pt-10">
        <a href="{{ route('client.product', $product["slug"]) }}">
            <img src="{{ $product["img"] }}" alt="Shoes" class="rounded-xl" />
        </a>

        @if ($product["lelang"])
            <x-client.logo-lelang :endtime="$product["lelang"]["endtime"]" />
        @else
            @if ($product->promo)
                <x-client.logo-promo />
            @endif
        @endif
    </figure>
    <div class="card-body items-center text-center">
        <h2 class="card-title">Shoes!</h2>
        <p>If a dog chews shoes whose shoes does he choose?</p>
        <div class="card-actions">
            <div class="tooltip tooltip-bottom" data-tip="Tambah ke keranjang">
                <button class="btn btn-circle btn-primary"><i class="fa fa-opencart"></i></button>
            </div>
        </div>
    </div>
</div>

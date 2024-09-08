<div
    class="img-slide-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto lg:w-1/4">
    <div class="swiper mySwiper2">
        <div class="swiper-wrapper">
            @if ($product->product_pictures->isNotEmpty())
                @foreach ($product->product_pictures as $picture)
                    <div class="swiper-slide">
                        <img src="{{ Storage::url($picture->path) }}" />
                        @if(isset($product->auction) && $product->auction->active)
                            <x-client.logo-lelang :endtime="$product->auction->endtime" />
                        @elseif(isset($product->promo) && $product->promo->active)
                                <x-client.logo-promo />
                        @endif
                    </div>
                @endforeach
            @else
                <img src="{{ '/assets/images/image-not-found.webp' }}" alt="{{ $product->name }}" class="rounded-xl" />
            @endif
        </div>
    </div>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($product->product_pictures as $picture)
                <div class="swiper-slide">
                    <img src="{{ Storage::url($picture->path) }}" />
                </div>
            @endforeach
        </div>
    </div>
</div>

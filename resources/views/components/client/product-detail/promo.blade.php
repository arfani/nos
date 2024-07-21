<div
    class="img-slide-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto lg:w-1/4">
    <div class="swiper mySwiper2">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/a.jpg') }}" />
                <x-client.logo-promo />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/b.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/c.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/d.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/e.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/f.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/c.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/d.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/e.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/a.jpg') }}" />
            </div>
        </div>
    </div>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/a.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/b.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/c.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/d.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/e.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/f.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/c.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/d.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/e.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('mocks/a.jpg') }}" />
            </div>
        </div>
    </div>
</div>

<div
    class="detail-product-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto md:flex-1 mb-6">
    <h1 class="text-center text-xl sm:text-2xl font-bold">
        {{ $product['name'] }}
        ( <span class="animate-pulse">PROMO !!!</span> )
    </h1>

    <div class="divider">Deskripsi</div>
    <p>{{ $product['description'] ?? 'No description' }}</p>
    
    <div class="divider">
        Harga <i class="fa fa-tags text-red-500 text-2xl"></i>
    </div>

    <span class="line-through">
        <x-client.format-rp :value="$product['price']" />
    </span>
    <span class="text-xs align-top ml-2">-{{ $product['promo']['discount'] }}%</span>
    <br />
    <x-client.format-rp :value="$product['price'] * (1 - $product['promo']['discount'] / 100)" />

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

    @if ($product['detail'])
        <div class="divider">Spesifikasi</div>
        @foreach ($product['detail'] as $detail)
            <div class="specification">
                <span>{{ $detail['name'] }}</span> : <span>{{ $detail['value'] }}</span>
            </div>
        @endforeach
    @endif
</div>

<div
    class="action-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto md:mx-0 md:ml-auto lg:w-1/4 mb-6">
    <h1>Atur jumlah dan catatan</h1>
    <div class="divider"></div>
    <input type="number" min="1" value="1" class="input w-20 mb-2">
    <div>Sisa stok : {{ $product['stock'] }}</div>
    <input type="text" class="input w-11/12 my-2" placeholder="Catatan">
    <div class="mb-2">Subtotal : 100.000</div>
    <div class="flex justify-center gap-3 mt-4">
        <button class="btn btn-ghost btn-sm text-lg "><i class="fa fa-share-nodes"></i></button>
        <button class="btn btn-ghost btn-sm text-lg text-secondary"><i class="fa fa-heart-circle-plus"></i></button>
        <button class="btn btn-ghost btn-sm text-lg "><i class="fa fa-opencart"></i></button>
    </div>
</div>

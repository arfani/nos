<div
    class="img-slide-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto lg:w-1/4 mb-6">
    <div class="swiper mySwiper2">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/a.jpg') }}" />
                <x-client.logo-lelang :endtime="$product['lelang']['endtime']" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/b.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/c.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/d.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/e.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/f.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/c.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/d.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/e.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/a.jpg') }}" />
            </div>
        </div>
    </div>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/a.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/b.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/c.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/d.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/e.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/f.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/c.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/d.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/e.jpg') }}" />
            </div>
            <div class="swiper-slide">
                <img src="{{ Storage::url('public/mocks/a.jpg') }}" />
            </div>
        </div>
    </div>
</div>

<div
    class="detail-product-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto md:flex-1 mb-6">
    <h1 class="text-center text-xl sm:text-2xl font-bold">
        {{ $product['name'] }}
        ( <span class="animate-pulse">DILELANG !!!</span> )
    </h1>

    <div class="divider">Berlaku Hingga</div>
    <div class="text-center text-info text-lg font-bold">
        {{ Carbon\Carbon::parse($product['lelang']['endtime'])->isoFormat('LLL') }} ({{ config('app.timezone') }})
    </div>

    <div class="divider">
        Harga <i class="fa fa-hammer fa-flip-horizontal text-blue-500 text-2xl"></i>
    </div>
    <div class="mb-2">
        Harga Awal : <x-client.format-rp :value="$product['lelang']['bidStart']" />
    </div>
    <div>
        Minimal Bid : <x-client.format-rp :value="$product['lelang']['bidIncrement']" />
    </div>

    <div class="divider">Ketentuan Lelang</div>
    <div>{!! $product['lelang']['ketentuan'] !!}</div>


    @if ($product['variants'])
        <div class="divider">Varian</div>
        <div class="variant mb-1">
            <span class="variant-item">Warna</span> :
            <select class="select" name="warna" disabled>
                <option value="putih">putih</option>
                <option value="merah">merah</option>
                <option value="hijau">hijau</option>
            </select>
        </div>
        <div class="variant">
            <span class="variant-item">Ukuran</span> :
            <select class="select" name="ukuran" disabled>
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

    <div class="divider">Deskripsi</div>
    <p>{{ $product['description'] ?? 'No description' }}</p>
</div>

<div
    class="action-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto md:mx-0 md:ml-auto lg:w-1/4">
    <h1>Informasi lelang</h1>
    <div class="divider"></div>

    <div class="flex items-center gap-2 mb-2">
        <span class="">Bid Tertinggi</span>
        <span class="bg-secondary text-secondary-content py-2 px-4 rounded"><x-client.format-rp value="210000" /></span>
    </div>
    <div class="flex items-center gap-2">
        <span class="">Oleh</span>
        <span class="bg-secondary text-secondary-content py-2 px-4 rounded">{{ 'Fulan' }}</span>
    </div>

    <div class="flex justify-center gap-3 mt-4">
        <div class="tooltip" data-tip="Bagikan">
            <button class="btn btn-ghost btn-sm text-lg "><i class="fa fa-share-nodes"></i></button>
        </div>
        <div class="tooltip" data-tip="Favorit">
            <button class="btn btn-ghost btn-sm text-lg text-secondary"><i class="fa fa-heart-circle-plus"></i></button>
        </div>
        <div class="tooltip" data-tip="Ikuti Lelang">
            <a href="#bidding" class="btn btn-ghost btn-sm text-lg "><i class="fa fa-bullseye"></i></a>
        </div>
    </div>
</div>

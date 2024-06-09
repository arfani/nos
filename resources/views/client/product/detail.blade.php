<x-client-layout>
    <div class="flex flex-wrap gap-2 mb-4">
        <div class="img-slide-container rounded bg-base-300 text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto lg:w-1/4">
            <div class="swiper mySwiper2">
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

        <div class="detail-product-container rounded bg-base-300 text-base-content p-4 w-100 h-fit sm:w-3/4 md:w-1/2 mx-auto md:flex-1 ">
            <h1 class="text-center text-xl sm:text-2xl font-bold">Nama produk disini</h1>
            <div class="divider">Harga</div>
            <div class="variant">
                Rp. 100.000
            </div>
            <div class="divider">Variasi</div>
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
                    <option value="m">m</option>
                    <option value="l">l</option>
                    <option value="xl">xl</option>
                </select>
            </div>
            <div class="divider">Spesifikasi</div>
            <div class="specification">
                <span class="spec-item">Berat</span> : <span class="value">1 kg</span>
            </div>
            <div class="specification">
                <span class="spec-item">Kondisi</span> : <span class="value">Baru</span>
            </div>
            <div class="divider">Deskripsi</div>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum, fugit?</p>
        </div>

        <div class="action-container rounded bg-base-300 text-base-content p-4 w-100 h-fit sm:w-3/4 md:w-1/2 mx-auto md:mx-0 md:ml-auto lg:w-1/4">
            <h1>Atur jumlah dan catatan</h1>
            <div class="divider"></div>
            <input type="number" min="1" value="1" class="input w-20 mb-2"> <span>Sisa stok : 1000</span>
            <input type="text" class="input w-11/12 mb-2" placeholder="Catatan">
            <div class="mb-2">Subtotal : 100.000</div>
            <div class="flex justify-center gap-1">
                <button class="btn btn-ghost btn-sm">share</button>
                <button class="btn btn-ghost btn-sm">favorit</button>
                <button class="btn btn-ghost btn-sm">keranjang</button>
            </div>
        </div>
    </div>

    <x-client.features />
    @push('scripts')
        @vite(['resources/css/client/detail-product.css', 'resources/js/client/detail-product.js'])
    @endpush
</x-client-layout>

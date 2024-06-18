@props([
    'products' => [
        [
            'name' => 'Product test 1',
            'slug' => 'product_test_1',
            'img' => Storage::url('public/mocks/a.jpg'),
            'price' => 10000,
            'promo' => [
                'active' => false,
                'discount' => 20,
            ],
            'variants' => true,
            'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
            'description' => 'lorem ipsum lorem amet ipsum',
            'stock' => 200,
            'lelang' => [
                'active' => false,
                'endtime' => now()->addDays(3),
                'bidStart' => 100000,
                'bidIncrement' => 5000,
                'ketentuan' => 'lorem ipsum dolor amet set',
            ],
        ],
        [
            'name' => 'Product test 2',
            'slug' => 'product_test_2',
            'img' => Storage::url('public/mocks/b.jpg'),
            'price' => 10000,
            'promo' => [
                'active' => true,
                'discount' => 20,
            ],
            'variants' => true,
            'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
            'description' => 'lorem ipsum lorem amet ipsum',
            'stock' => 200,
            'lelang' => [
                'active' => false,
                'endtime' => now()->addDays(3),
                'bidStart' => 100000,
                'bidIncrement' => 5000,
                'ketentuan' => 'lorem ipsum dolor amet set',
            ],
        ],
        [
            'name' => 'Product test 3',
            'slug' => 'product_test_3',
            'img' => Storage::url('public/mocks/c.jpg'),
            'price' => 10000,
            'promo' => [
                'active' => false,
                'discount' => 20,
            ],
            'variants' => true,
            'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
            'description' => 'lorem ipsum lorem amet ipsum',
            'stock' => 200,
            'lelang' => [
                'active' => true,
                'endtime' => now()->addDays(3),
                'bidStart' => 100000,
                'bidIncrement' => 5000,
                'ketentuan' => 'lorem ipsum dolor amet set',
            ],
        ],
    ],
])

<x-client-layout>
    @push('styles')
        @vite(['resources/css/client/home.css'])
    @endpush
    @if (session('status') == 'email-is-verified')
        <div x-data="{ show: false }" x-show="show" x-init="setTimeout(() => show = true, 100)
        setTimeout(() => show = false, 5000)" @click="show = false"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0"
            role="alert" class="alert alert-warning w-fit fixed right-10 z-50">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="stroke-current shrink-0 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Email Anda sudah terverifikasi</span>
        </div>
    @endif

    @if (session('status') == 'verify-email-success')
        <div x-data="{ show: false }" x-show="show" x-init="setTimeout(() => show = true, 100)
        setTimeout(() => show = false, 5000)" @click="show = false"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0"
            role="alert" class="alert alert-warning w-fit fixed right-10 z-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Email Anda berhasil diverifikasi</span>
        </div>
    @endif

    {{-- NOTICE --}}
    <div class="notice mb-6" x-data="{
        noticeMessage: '{{ $notice->message }}',
        noticeKey: 'noticeDismissed_{{ $notice->updated_at }}',
        previousNoticeKey: localStorage.getItem('currentNoticeKey'),
        showNotice: true,
        initialize() {
            this.cleanOldNotice();
            this.showNotice = !localStorage.getItem(this.noticeKey);
            localStorage.setItem('currentNoticeKey', this.noticeKey);
            console.log(this.noticeMessage);
        },
        dismissNotice() {
            localStorage.setItem(this.noticeKey, 'true');
            this.showNotice = false;
        },
        cleanOldNotice() {
            if (this.previousNoticeKey && this.previousNoticeKey !== this.noticeKey) {
                localStorage.removeItem(this.previousNoticeKey);
            }
        }
    }" x-init="initialize()" x-show="showNotice">
        <div role="alert" class="alert">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="stroke-info shrink-0 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span x-text="noticeMessage"></span>
            <div>
                <button class="btn btn-sm" @click="dismissNotice"><i class="fa fa-xmark"></i></button>
                <a href="{{ $notice->link }}" class="btn btn-sm btn-primary"
                    x-show="'{{ $notice->link }}' !== ''">Lihat</a>
            </div>
        </div>
    </div>

    {{-- HERO --}}
    <div class="hero bg-base-200 mb-14">
        <div class="hero-content flex-col sm:flex-row-reverse lg:mx-10">
            <div class="!w-60 sm:!w-80 swiper heroSwiper">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide rounded-box mask mask-squircle">
                        <img src="{{ Storage::url('public/sliders/a.jpg') }}" class="w-full"
                            alt="Tailwind CSS Carousel component" />
                    </div>
                    <div class="swiper-slide rounded-box mask mask-squircle">
                        <img src="{{ Storage::url('public/sliders/b.jpg') }}" class="w-full"
                            alt="Tailwind CSS Carousel component" />
                    </div>
                    <div class="swiper-slide rounded-box mask mask-squircle">
                        <img src="{{ Storage::url('public/sliders/c.jpg') }}" class="w-full"
                            alt="Tailwind CSS Carousel component" />
                    </div>
                </div>
            </div>
            <div class="text-center sm:text-left w-fit">
                <h1 class="text-2xl sm:text-3xl font-bold">Barang Bergaransi !</h1>
                <p class="py-6">Kualitas tinggi dengan garansi Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Repellendus alias est voluptate rerum dolorem ad culpa quos, voluptates itaque reiciendis
                    maxime eum, odit deleniti in at ratione asperiores iste facere.</p>
                <div class="relative">
                    @include('components_custom.button-hero')
                </div>
            </div>
        </div>
    </div>

    {{-- PROMO --}}
    <div class="promo mb-14">
        <h2 class="text-center text-3xl uppercase font-bold tracking-wider">Spesial Promo <i
                class="fa fa-tags text-red-500 text-2xl pb-1"></i></h2>
        <div class="swiper promoSwiper w-full pt-5">
            <div class="w-full text-center mt-2 mb-6">
                <a href="{{ route('client.promo') }}" class="btn btn-primary btn-sm btn-ghost tracking-wider">Lihat
                    Semua</a>
            </div>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <x-client.logo-promo />
                    <a href="{{ route('client.product', 'test') }}">
                        <img src="{{ Storage::url('public/mocks/a.jpg') }}" />
                    </a>
                </div>
                <div class="swiper-slide">
                    <x-client.logo-promo />
                    <a href="{{ route('client.product', 'test') }}">
                        <img src="{{ Storage::url('public/mocks/b.jpg') }}" />
                    </a>
                </div>
                <div class="swiper-slide">
                    <x-client.logo-promo />
                    <a href="{{ route('client.product', 'test') }}">
                        <img src="{{ Storage::url('public/mocks/c.jpg') }}" />
                    </a>
                </div>
                <div class="swiper-slide">
                    <x-client.logo-promo />
                    <a href="{{ route('client.product', 'test') }}">
                        <img src="{{ Storage::url('public/mocks/d.jpg') }}" />
                    </a>
                </div>
                <div class="swiper-slide">
                    <x-client.logo-promo />
                    <a href="{{ route('client.product', 'test') }}">
                        <img src="{{ Storage::url('public/mocks/e.jpg') }}" />
                    </a>
                </div>
                <div class="swiper-slide">
                    <x-client.logo-promo />
                    <a href="{{ route('client.product', 'test') }}">
                        <img src="{{ Storage::url('public/mocks/f.jpg') }}" />
                    </a>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>


    {{-- LELANG --}}
    <div class="lelang mb-14 bg-base-300 pt-10 pb-12">
        <h2 class="text-center mb-10 text-3xl uppercase font-bold tracking-wider">Barang Lelang <i
                class="fa fa-hammer fa-flip-horizontal text-blue-500"></i></h2>

        <div class="flex flex-col lg:flex-row items-center">
            <div class="swiper lelangSwiper mb-10 lg:mb-0 !w-60 !h-60">
                <div class="swiper-wrapper lg:mx-24">
                    <div class="swiper-slide [&>img]:h-full [&>img]:w-full">
                        <x-client.countdown :endtime="now()->addDays(2)" />
                        <a href="{{ route('client.product', 'test') }}">
                            <img src="{{ Storage::url('public/mocks/a.jpg') }}" alt="" srcset="">
                        </a>
                    </div>
                    <div class="swiper-slide [&>img]:h-full [&>img]:w-full">
                        <x-client.countdown :endtime="now()->addDays(2)" />
                        <a href="{{ route('client.product', 'test') }}">
                            <img src="{{ Storage::url('public/mocks/b.jpg') }}" alt="" srcset="">
                        </a>
                    </div>
                    <div class="swiper-slide [&>img]:h-full [&>img]:w-full">
                        <x-client.countdown :endtime="now()->addDays(2)" />
                        <a href="{{ route('client.product', 'test') }}">
                            <img src="{{ Storage::url('public/mocks/c.jpg') }}" alt="" srcset="">
                        </a>
                    </div>
                    <div class="swiper-slide [&>img]:h-full [&>img]:w-full">
                        <x-client.countdown :endtime="now()->addDays(7)" />
                        <a href="{{ route('client.product', 'test') }}">
                            <img src="{{ Storage::url('public/mocks/d.jpg') }}" alt="" srcset="">
                        </a>
                    </div>
                    <div class="swiper-slide [&>img]:h-full [&>img]:w-full">
                        <x-client.countdown :endtime="now()->addDays(4)" />
                        <a href="{{ route('client.product', 'test') }}">
                            <img src="{{ Storage::url('public/mocks/e.jpg') }}" alt="" srcset="">
                        </a>
                    </div>
                    <div class="swiper-slide [&>img]:h-full [&>img]:w-full">
                        <x-client.countdown :endtime="now()->addDays(5)" />
                        <a href="{{ route('client.product', 'test') }}">
                            <img src="{{ Storage::url('public/mocks/f.jpg') }}" alt="" srcset="">
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center flex-1 lg:ml-32 lg:mr-8">
                <h1 class="text-xl sm:text-2xl font-bold">Jangan Lewatkan !</h1>
                <p class="py-4">Segera checkout barang-barang yang kami lelang sebelum terlambat !! Lorem ipsum
                    dolor,
                    sit
                    amet consectetur adipisicing elit. Debitis rerum, cumque quidem nam mollitia aperiam suscipit
                    voluptatem fugit earum ipsa ducimus provident excepturi ullam ipsum unde ratione, dolore voluptates
                    non?</p>
                <a href="{{ route('client.lelang') }}" class="btn btn-primary tracking-wider">Lihat Semua</a>
            </div>
        </div>
    </div>


    {{-- PRODUCTS --}}
    <div class="products">
        <h2 class="text-center mb-10 text-3xl uppercase font-bold tracking-wider">PRODUK KAMI</h2>

        <div class="flex flex-wrap justify-around">
            @foreach ($products as $item)
                <x-client.product-item :product="$item" />
            @endforeach
        </div>

        <div class="w-full text-center my-2">
            <a href="{{ route('client.products') }}" class="btn btn-primary btn-ghost tracking-wider">Lihat Semua
                Produk</a>
        </div>
    </div>

    <x-client.features />

    {{-- TESTIMONIAL --}}
    <div class="testimonial mb-14 pt-10">
        <h2 class="text-center text-3xl uppercase font-bold tracking-wider">Kata Pelanggan Kami</h2>

        <div class="flex flex-col lg:flex-row items-center">

            <div class="swiper testimonialSwiper mb-10 lg:mb-0 !w-3/4 !my-6">
                <div class="swiper-wrapper !my-10">
                    <div class="swiper-slide !bg-transparent">
                        <div class="chat chat-start">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS chat bubble component"
                                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <div class="chat-header text-primary">
                                Obi-Wan Kenobi
                            </div>
                            <div class="chat-bubble bg-secondary text-secondary-content">Lorem ipsum dolor, sit amet
                                consectetur possimus,
                                iusto numquam optio tempora accusantium excepturi perferendis itaque, amet sit libero
                                consectetur alias exercitationem, veniam saepe.</div>
                        </div>
                    </div>
                    <div class="swiper-slide !bg-transparent">
                        <div class="chat chat-start">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS chat bubble component"
                                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <div class="chat-header text-primary">
                                Obi-Wan Kenobi
                            </div>
                            <div class="chat-bubble bg-secondary text-secondary-content">Lorem ipsum dolor, sit amet
                                consectetur possimus,
                                iusto numquam optio tempora accusantium excepturi perferendis itaque, amet sit libero
                                consectetur alias exercitationem, veniam saepe.</div>
                        </div>
                    </div>
                    <div class="swiper-slide !bg-transparent">
                        <div class="chat chat-start">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS chat bubble component"
                                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <div class="chat-header text-primary">
                                Obi-Wan Kenobi
                            </div>
                            <div class="chat-bubble bg-secondary text-secondary-content">Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Incidunt reprehenderit laboriosam aperiam quam possimus,
                                iusto numquam optio tempora accusantium excepturi perferendis itaque, amet sit libero
                                consectetur alias exercitationem, veniam saepe.</div>
                        </div>
                    </div>
                    <div class="swiper-slide !bg-transparent">
                        <div class="chat chat-start">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS chat bubble component"
                                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <div class="chat-header text-primary">
                                Obi-Wan Kenobi
                            </div>
                            <div class="chat-bubble bg-secondary text-secondary-content">Lorem ipspe.</div>
                        </div>
                    </div>
                    <div class="swiper-slide !bg-transparent">
                        <div class="chat chat-start">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS chat bubble component"
                                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <div class="chat-header text-primary">
                                Obi-Wan Kenobi
                            </div>
                            <div class="chat-bubble bg-secondary text-secondary-content">Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Incidunt reprehenderit laboriosam aperiam quam possimus,
                                iusto numquam optio tempora accusantium excepturi perferendis itaque, amet sit libero
                                consectetur alias exercitationem, veniam saepe.</div>
                        </div>
                    </div>
                    <div class="swiper-slide !bg-transparent">
                        <div class="chat chat-start">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS chat bubble component"
                                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <div class="chat-header text-primary">
                                Obi-Wan Kenobi
                            </div>
                            <div class="chat-bubble bg-secondary text-secondary-content">Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Incidunt reprehenderit laboriosam aperiam quam possimus,
                                iusto numquam optio tempora accusantium excepturi perferendis itaque, amet sit libero
                                consectetur alias exercitationem, veniam saepe.</div>
                        </div>
                    </div>
                    <div class="swiper-slide !bg-transparent">
                        <div class="chat chat-start">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS chat bubble component"
                                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <div class="chat-header text-primary">
                                Obi-Wan Kenobi
                            </div>
                            <div class="chat-bubble bg-secondary text-secondary-content">Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Incidunt reprehenderit laboriosam aperiam quam possimus,
                                iusto numquam optio tempora accusantium excepturi perferendis itaque, amet sit libero
                                consectetur alias exercitationem, veniam saepe.</div>
                        </div>
                    </div>
                    <div class="swiper-slide !bg-transparent">
                        <div class="chat chat-start">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS chat bubble component"
                                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <div class="chat-header text-primary">
                                Obi-Wan Kenobi
                            </div>
                            <div class="chat-bubble bg-secondary text-secondary-content">Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Incidunt reprehenderit laboriosam aperiam quam possimus,
                                iusto numquam optio tempora accusantium excepturi perferendis itaque, amet sit libero
                                consectetur alias exercitationem, veniam saepe.</div>
                        </div>
                    </div>
                    <div class="swiper-slide !bg-transparent">
                        <div class="chat chat-start">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS chat bubble component"
                                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <div class="chat-header text-primary">
                                Obi-Wan Kenobi
                            </div>
                            <div class="chat-bubble bg-secondary text-secondary-content">Lorem ipsum dolor, sit amet
                                consectetur adipisicing elit. Incidunt reprehenderit laboriosam aperiam quam possimus,
                                iusto numquam optio tempora accusantium excepturi perferendis itaque, amet sit libero
                                consectetur alias exercitationem, veniam saepe.</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- FAQ --}}
    <div class="faq mb-10">
        <h2 class="text-center text-3xl uppercase font-bold tracking-wider mb-10">Yang Sering ditanyakan</h2>

        <div class="collapse collapse-arrow bg-base-200 w-fit mx-9 mb-1">
            <input type="radio" name="faq" checked="checked" />
            <div class="collapse-title text-xl font-medium bg-base-300">
                Click to open this one and close others
            </div>
            <div class="collapse-content pt-2">
                <p>hello Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima illum deserunt tenetur,
                    architecto repudiandae minus. Earum ut, eveniet non neque quidem, rem eos dicta sint, ex iure id
                    quae ea?</p>
            </div>
        </div>
        <div class="collapse collapse-arrow bg-base-200 w-fit mx-9 mb-1">
            <input type="radio" name="faq" />
            <div class="collapse-title text-xl font-medium bg-base-300">
                Click to open this one and close others
            </div>
            <div class="collapse-content pt-2">
                <p>hello</p>
            </div>
        </div>
        <div class="collapse collapse-arrow bg-base-200 w-fit mx-9 mb-1">
            <input type="radio" name="faq" />
            <div class="collapse-title text-xl font-medium bg-base-300">
                Click to open this one and close othersthis one and close othersthis one and close others
            </div>
            <div class="collapse-content pt-2">
                <p>hello</p>
            </div>
        </div>
    </div>

    {{-- BRANDS --}}
    <div class="brands my-20">
        <h2 class="text-center text-3xl uppercase font-bold tracking-wider mb-10">Brand Kami</h2>

        <div class="swiper brandsSwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ Storage::url('public/mocks/brands/a.webp') }}" alt="brand's logo">
                </div>
                <div class="swiper-slide">
                    <img src="{{ Storage::url('public/mocks/brands/b.webp') }}" alt="brand's logo">
                </div>
                <div class="swiper-slide">
                    <img src="{{ Storage::url('public/mocks/brands/c.webp') }}" alt="brand's logo">
                </div>
                <div class="swiper-slide">
                    <img src="{{ Storage::url('public/mocks/brands/d.webp') }}" alt="brand's logo">
                </div>
                <div class="swiper-slide">
                    <img src="{{ Storage::url('public/mocks/brands/e.webp') }}" alt="brand's logo">
                </div>
                <div class="swiper-slide">
                    <img src="{{ Storage::url('public/mocks/brands/f.webp') }}" alt="brand's logo">
                </div>
                <div class="swiper-slide">
                    <img src="{{ Storage::url('public/mocks/brands/g.webp') }}" alt="brand's logo">
                </div>
                <div class="swiper-slide">
                    <img src="{{ Storage::url('public/mocks/brands/h.webp') }}" alt="brand's logo">
                </div>
                <div class="swiper-slide">
                    <img src="{{ Storage::url('public/mocks/brands/i.webp') }}" alt="brand's logo">
                </div>
                <div class="swiper-slide">
                    <img src="{{ Storage::url('public/mocks/brands/j.webp') }}" alt="brand's logo">
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</x-client-layout>

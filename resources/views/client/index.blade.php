{{-- @props([
    'products' => [
        [
            'name' => 'Product test 1',
            'slug' => 'product_test_1',
            'img' => Storage::url('mocks/a.jpg'),
            'stock' => 200,
            'price' => 10000,
            'promo' => [
                'active' => false,
                'discount' => 20,
            ],
            'variants' => true,
            'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
            'description' => 'lorem ipsum lorem amet ipsum',
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
            'img' => Storage::url('mocks/b.jpg'),
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
            'img' => Storage::url('mocks/c.jpg'),
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
                'active' => true,
                'endtime' => now()->addDays(3),
                'bidStart' => 100000,
                'bidIncrement' => 5000,
                'ketentuan' => 'lorem ipsum dolor amet set',
            ],
        ],
    ],
]) --}}

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
        <div role="alert" class="alert bg-primary text-primary-content py-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="stroke-black animate-pulse shrink-0 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span x-text="noticeMessage"></span>
            <div class="flex gap-1">
                <a href="{{ $notice->link }}" class="btn btn-sm btn-secondary"
                    x-show="'{{ $notice->link }}' !== ''">Lihat</a>
                <button
                    class="btn btn-sm btn-circle bg-transparent outline-none border-0 hover:text-primary text-primary-content"
                    @click="dismissNotice"><i class="fa fa-xmark"></i></button>
            </div>
        </div>
    </div>

    {{-- HERO --}}
    @if ($hero['data']->is_show)
        <div class="hero bg-base-200 mb-14">
            <div class="hero-content flex-col sm:flex-row-reverse lg:mx-10">
                <div class="!w-60 sm:!w-80 swiper heroSwiper">
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach ($hero['product_pictures'] as $product)
                            @if ($product->product_pictures->isNotEmpty())
                                <div class="swiper-slide rounded-box mask mask-squircle">
                                    <img src="{{ Storage::url($product->product_pictures->first()->path) }}"
                                        class="w-full" alt="product images" />
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="text-center sm:text-left w-fit">
                    <h1 class="text-2xl sm:text-3xl font-bold">{{ $hero['data']->title }}</h1>
                    <p class="py-6">
                        {{ $hero['data']->description }}
                    </p>
                    <div class="relative">
                        @include('components_custom.button-hero')
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- PROMO --}}
    @if ($promo['data']->is_show)
        <div class="promo mb-14">
            <h2 class="text-center text-3xl uppercase font-bold tracking-wider">
                {{ $promo['data']->title }} <i class="fa fa-tags text-red-500 text-2xl pb-1"></i>
            </h2>
            <p class="text-center pt-2">{{ $promo['data']->description }}</p>
            <div class="swiper promoSwiper w-full pt-5">
                <div class="w-full text-center mt-2 mb-6">
                    <a href="{{ route('client.promo') }}" class="btn btn-primary btn-sm btn-ghost tracking-wider">
                        Lihat Semua
                    </a>
                </div>
                <div class="swiper-wrapper">
                    @foreach ($promo['items'] as $promo_item)
                        <div class="swiper-slide">
                            <x-client.logo-promo />
                            <a href="{{ route('client.product', $promo_item->product->slug) }}">
                                <div class="absolute inset-0 flex items-center justify-center text-3xl">
                                    <div
                                        class="top-4 left-2 bg-gradient-to-tr from-red-500 to-yellow-200 text-black px-3 py-1 rounded-full font-bold shadow-md transform -rotate-12">
                                        <x-client.format-rp
                                            value="{{ $promo_item->product->product_variant[0]->price }}" />
                                    </div>
                                </div>
                                @if ($promo_item->product->product_pictures->isNotEmpty())
                                    <img
                                        src="{{ Storage::url($promo_item->product->product_pictures->first()->path) }}" />
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    @endif

    {{-- LELANG --}}
    @if ($auction['data']->is_show)
        <div class="lelang mb-14 bg-base-300 pt-10 pb-12">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="swiper lelangSwiper mb-10 lg:mb-0 !w-60 !h-60">
                    <div class="swiper-wrapper lg:mx-24">
                        @foreach ($auction['items'] as $auction_item)
                            <div class="swiper-slide [&>img]:h-full [&>img]:w-full">
                                <x-client.countdown :endtime="$auction_item->endtime" />
                                <a href="{{ route('client.product', $auction_item->product->slug) }}">
                                    <div class="absolute inset-x-0 top-1/3 flex items-center justify-center text-xl">
                                        <div
                                            class="top-4 left-2 bg-gradient-to-tr from-red-500 to-yellow-200 text-black px-3 py-1 rounded font-bold shadow-md transform -rotate-12">
                                            <div>Mulai dari</div>
                                            <x-client.format-rp value="{{ $auction_item->bid_start }}" />
                                        </div>
                                    </div>
                                    @if ($auction_item->product->product_pictures->isNotEmpty())
                                        <img
                                            src="{{ Storage::url($auction_item->product->product_pictures->first()->path) }}" />
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="text-center flex-1 lg:ml-32 lg:mr-8">
                    <h2 class="text-center mb-2 text-3xl uppercase font-bold tracking-wider">
                        {{ $auction['data']->title }} <i class="fa fa-hammer fa-flip-horizontal text-blue-500"></i>
                    </h2>
                    <p class="py-4">
                        {{ $auction['data']->description }}
                    </p>
                    <a href="{{ route('client.lelang') }}" class="btn btn-primary tracking-wider">Lihat Semua</a>
                </div>
            </div>
        </div>
    @endif

    {{-- PRODUCTS --}}
    @if ($products['data']->is_show)
        <div class="products">
            <h2 class="text-center text-3xl uppercase font-bold tracking-wider">{{ $products['data']->title }}</h2>
            <p class="text-center mb-8 mt-2">{{ $products['data']->description }}</p>
            <div class="flex flex-wrap justify-around">
                @foreach ($products['items'] as $product)
                    <x-client.product-item :product="$product" />
                @endforeach
            </div>

            <div class="w-full text-center my-2">
                <a href="{{ route('client.products') }}" class="btn btn-primary btn-ghost tracking-wider">Lihat Semua
                    Produk</a>
            </div>
        </div>
    @endif

    <x-client.features />

    {{-- TESTIMONIAL --}}
    @if ($testimonial['data']->is_show)
        <div class="testimonial mb-14 pt-10">
            <h2 class="text-center text-3xl uppercase font-bold tracking-wider">{{ $testimonial['data']->title }}</h2>
            <p class="text-center mt-2">{{ $testimonial['data']->description }}</p>
            <div class="flex flex-col lg:flex-row items-center">
                <div class="swiper testimonialSwiper mb-10 lg:mb-0 !w-3/4 !my-2">
                    <div class="swiper-wrapper !my-10">
                        @foreach ($testimonial['items'] as $testi)
                            <div class="swiper-slide !bg-transparent">
                                <div class="chat chat-start">
                                    <div class="chat-image avatar">
                                        <div class="w-10 rounded-full">
                                            <img alt="profile photo"
                                                src="{{ isset($testi->img) ? Storage::url($testi->img) : asset('assets/images/image-not-found.webp') }}" />
                                        </div>
                                    </div>
                                    <div class="chat-header text-primary ml-2">
                                        {{ $testi->name }}
                                    </div>
                                    <div class="chat-bubble bg-secondary text-secondary-content">
                                        {{ $testi->message }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- FAQ --}}
    @if ($faq['data']->is_show)
        <div class="faq mb-10">
            <h2 class="text-center text-3xl uppercase font-bold tracking-wider">{{ $faq['data']->title }}</h2>
            <p class="text-center mt-2 mb-8">{{ $faq['data']->description }}</p>
            @foreach ($faq['items'] as $faq_item)
                <div class="collapse collapse-arrow bg-base-200 w-fit mx-9 mb-1">
                    <input type="radio" name="faq" />
                    <div class="collapse-title text-xl font-medium bg-base-300">
                        {{ $faq_item->question }}
                    </div>
                    <div class="collapse-content pt-2">
                        <p>{{ $faq_item->answer }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- BRANDS --}}
    @if ($brand['data']->is_show)
        <div class="brands my-20">
            <h2 class="text-center text-3xl uppercase font-bold tracking-wider">{{ $brand['data']->title }}</h2>
            <p class="text-center mt-2 mb-8">{{ $brand['data']->description }}</p>
            <div class="swiper brandsSwiper">
                <div class="swiper-wrapper">
                    @foreach ($brand['items'] as $brand_item)
                        <div class="swiper-slide">
                            <a href="{{ $brand_item->link }}">
                                <img src="{{ Storage::url($brand_item->logo) }}" alt="logo {{ $brand_item->name }}">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    @endif
</x-client-layout>

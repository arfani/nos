<x-client-layout>
    {{-- HERO --}}
    <div class="hero bg-base-200 mb-6">
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

    {{-- NOTICE --}}
    <div
        class="runtext-container overflow-x-hidden bg-warning/50 text-warning-content shadow-sm mb-14 sm:-ml-[33px] sm:w-screen">
        <a href="/barang/reagen-ed">
            <div class="main-runtext">
                <div class="marquee">
                    <div class="holder">
                        <div class="text-container">
                            <p class="leading-10">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    {{-- PROMO --}}
    <div class="promo mb-14">
        <h2 class="text-center text-3xl uppercase font-bold tracking-wider">Spesial Promo</h2>
        <div class="swiper promoSwiper w-full pt-5">
            <div class="w-full text-center my-2">
                <button class="btn btn-primary btn-sm btn-ghost">Lihat Semua</button>
            </div>
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
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>


    {{-- LELANG --}}
    <div class="lelang mb-14 bg-base-300 pt-10 pb-12">
        <h2 class="text-center mb-10 text-3xl uppercase font-bold tracking-wider">Barang Lelang</h2>

        <div class="flex flex-col lg:flex-row items-center">
            <div class="swiper lelangSwiper mb-10 lg:mb-0 !w-60 !h-60">
                <div class="swiper-wrapper lg:mx-24 ">
                    <div class="swiper-slide">
                        {{-- <div class="grid grid-flow-col gap-5 text-center auto-cols-max verti">
                            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                                <span class="countdown font-mono">
                                    <span style="--value:15;"></span>
                                </span>
                                days
                            </div>
                            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                                <span class="countdown font-mono">
                                    <span style="--value:10;"></span>
                                </span>
                                hours
                            </div>
                            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                                <span class="countdown font-mono">
                                    <span style="--value:24;"></span>
                                </span>
                                min
                            </div>
                            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                                <span class="countdown font-mono">
                                    <span style="--value:49;"></span>
                                </span>
                                sec
                            </div>
                        </div> --}}
                        <img src="{{ Storage::url('public/mocks/f.jpg') }}" alt="" srcset="">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ Storage::url('public/mocks/a.jpg') }}" alt="" srcset="">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ Storage::url('public/mocks/b.jpg') }}" alt="" srcset="">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ Storage::url('public/mocks/c.jpg') }}" alt="" srcset="">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ Storage::url('public/mocks/d.jpg') }}" alt="" srcset="">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ Storage::url('public/mocks/e.jpg') }}" alt="" srcset="">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ Storage::url('public/mocks/f.jpg') }}" alt="" srcset="">
                    </div>
                </div>
            </div>

            <div class="text-center flex-1 lg:ml-32 lg:mr-8">
                <h1 class="text-xl sm:text-2xl font-bold">Jangan Lewatkan !</h1>
                <p class="py-4">Segera checkout barang-barang yang kami lelang sebelum terlambat !! Lorem ipsum dolor,
                    sit
                    amet consectetur adipisicing elit. Debitis rerum, cumque quidem nam mollitia aperiam suscipit
                    voluptatem fugit earum ipsa ducimus provident excepturi ullam ipsum unde ratione, dolore voluptates
                    non?</p>
                <button class="btn btn-primary">Lihat Semua</button>
            </div>
        </div>
    </div>


    {{-- PRODUCTS --}}
    <div class="products">
        <h2 class="text-center mb-10 text-3xl uppercase font-bold tracking-wider">PRODUK KAMI</h2>

        <div class="flex flex-wrap justify-around">
            <div class="card w-72 bg-base-200 shadow-xl mb-8">
                <figure class="px-10 pt-10">
                    <img src="{{ Storage::url('public/mocks/a.jpg') }}"
                        alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">Shoes!</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
            <div class="card w-72 bg-base-200 shadow-xl mb-8">
                <figure class="px-10 pt-10">
                    <img src="{{ Storage::url('public/mocks/b.jpg') }}"
                        alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">Shoes!</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
            <div class="card w-72 bg-base-200 shadow-xl mb-8">
                <figure class="px-10 pt-10">
                    <img src="{{ Storage::url('public/mocks/c.jpg') }}"
                        alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">Shoes!</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
            <div class="card w-72 bg-base-200 shadow-xl mb-8">
                <figure class="px-10 pt-10">
                    <img src="{{ Storage::url('public/mocks/d.jpg') }}"
                        alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">Shoes!</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
            <div class="card w-72 bg-base-200 shadow-xl mb-8">
                <figure class="px-10 pt-10">
                    <img src="{{ Storage::url('public/mocks/e.jpg') }}"
                        alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">Shoes!</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
            <div class="card w-72 bg-base-200 shadow-xl mb-8">
                <figure class="px-10 pt-10">
                    <img src="{{ Storage::url('public/mocks/b.jpg') }}"
                        alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">Shoes!</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
            <div class="card w-72 bg-base-200 shadow-xl mb-8">
                <figure class="px-10 pt-10">
                    <img src="{{ Storage::url('public/mocks/f.jpg') }}"
                        alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">Shoes!</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
            <div class="card w-72 bg-base-200 shadow-xl mb-8">
                <figure class="px-10 pt-10">
                    <img src="{{ Storage::url('public/mocks/c.jpg') }}"
                        alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">Shoes!</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
            <div class="card w-72 bg-base-200 shadow-xl mb-8">
                <figure class="px-10 pt-10">
                    <img src="{{ Storage::url('public/mocks/d.jpg') }}"
                        alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">Shoes!</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
            <div class="card w-72 bg-base-200 shadow-xl mb-8">
                <figure class="px-10 pt-10">
                    <img src="{{ Storage::url('public/mocks/a.jpg') }}"
                        alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">Shoes!</h2>
                    <p>If a dog chews shoes whose shoes does he choose?</p>
                    <div class="card-actions">
                        <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full text-center my-2">
            <button class="btn btn-primary btn-ghost">Lihat Semua Produk</button>
        </div>

    </div>

    {{-- FEATURES --}}
    <div class="features bg-base-200 rounded shadow-md py-10 mb-14 flex">
        <ul class="steps steps-vertical sm:steps-horizontal mx-auto">
            <li data-content="★" class="step step-primary">
                Support CS
            </li>
            <li data-content="★" class="step step-primary">
                Free Ongkir wilayah Jakaakarta
            </li>
            <li data-content="★" class="step step-primary">
                Barang Original
            </li>
            <li data-content="★" class="step step-primary">
                Bergaransi
            </li>
        </ul>
    </div>


    {{-- TESTIMONIAL --}}
    <div class="testimonial mb-14 pt-10">
        <h2 class="text-center text-3xl uppercase font-bold tracking-wider">Kata Pelanggan Kami</h2>

        <div class="flex flex-col lg:flex-row items-center">

            <div class="swiper testimonialSwiper mb-10 lg:mb-0 !w-3/4 !h-fit !my-6">
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


    @push('styles')
        <style>
            .promo .swiper-slide {
                background-position: center;
                background-size: cover;
                width: 300px;
                height: 300px;
            }

            .promo .swiper-slide img {
                display: block;
                width: 100%;
            }

            .lelang .swiper {
                /* width: 240px; */
                /* height: 320px; */
            }

            .lelang .swiper-slide {
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 22px;
                font-weight: bold;
                color: #000;
            }

            .lelang .swiper-slide:nth-child(1n) {
                background-color: rgb(206, 17, 17);
            }

            .lelang .swiper-slide:nth-child(2n) {
                background-color: rgb(0, 140, 255);
            }

            .lelang .swiper-slide:nth-child(3n) {
                background-color: rgb(10, 184, 111);
            }

            .lelang .swiper-slide:nth-child(4n) {
                background-color: rgb(211, 122, 7);
            }

            .lelang .swiper-slide:nth-child(5n) {
                background-color: rgb(118, 163, 12);
            }

            .lelang .swiper-slide:nth-child(6n) {
                background-color: rgb(180, 10, 47);
            }

            .lelang .swiper-slide:nth-child(7n) {
                background-color: rgb(35, 99, 19);
            }

            .lelang .swiper-slide:nth-child(8n) {
                background-color: rgb(0, 68, 255);
            }

            .lelang .swiper-slide:nth-child(9n) {
                background-color: rgb(218, 12, 218);
            }

            .lelang .swiper-slide:nth-child(10n) {
                background-color: rgb(54, 94, 77);
            }



            .testimonial .swiper {
                /* width: 240px; */
                /* height: 320px; */
            }

            .testimonial .swiper-slide {
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 18px;
                font-size: 22px;
                font-weight: bold;
                color: #000;
            }

            .testimonial .swiper-slide:nth-child(1n) {
                background-color: rgb(206, 17, 17);
            }

            .testimonial .swiper-slide:nth-child(2n) {
                background-color: rgb(0, 140, 255);
            }

            .testimonial .swiper-slide:nth-child(3n) {
                background-color: rgb(10, 184, 111);
            }

            .testimonial .swiper-slide:nth-child(4n) {
                background-color: rgb(211, 122, 7);
            }

            .testimonial .swiper-slide:nth-child(5n) {
                background-color: rgb(118, 163, 12);
            }

            .testimonial .swiper-slide:nth-child(6n) {
                background-color: rgb(180, 10, 47);
            }

            .testimonial .swiper-slide:nth-child(7n) {
                background-color: rgb(35, 99, 19);
            }

            .testimonial .swiper-slide:nth-child(8n) {
                background-color: rgb(0, 68, 255);
            }

            .testimonial .swiper-slide:nth-child(9n) {
                background-color: rgb(218, 12, 218);
            }

            .testimonial .swiper-slide:nth-child(10n) {
                background-color: rgb(54, 94, 77);
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // TOGGLE COLLAPSE FAQ
                const collapses = document.querySelectorAll('.collapse');
                collapses.forEach((collapse, index) => {
                    const title = collapse.querySelector('.collapse-title');
                    const radio = collapse.querySelector('input[type="radio"]');
                    collapse.addEventListener('click', function() {
                        radio.checked = radio.checked == true ? false : true;
                    });
                });
            });
        </script>
    @endpush
</x-client-layout>

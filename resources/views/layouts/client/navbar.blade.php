{{-- bottom navigation --}}
<div class="btm-nav md:hidden bg-base-300 text-primary z-20">
    <a href="{{ route('client.home') }}" @class(['active' => Request::routeIs('client.home')])>
        <div class="tooltip tooltip-primary" data-tip="Home">
            <span class="fa fa-home"></span>
        </div>
    </a>
    <a href="{{ route('client.lelang') }}" @class(['active' => Request::routeIs('client.lelang')])>
        <div class="tooltip tooltip-primary" data-tip="Lelang">
            <span class="fa fa-laptop"></span>
        </div>
    </a>
    <a href="{{ route('client.promo') }}" @class(['active' => Request::routeIs('client.promo')])>
        <div class="tooltip tooltip-primary" data-tip="Promo">
            <span class="fa fa-percent"></span>
        </div>
    </a>
    <a href="{{ route('client.notification') }}" @class(['active' => Request::routeIs('client.notification')])>
        <div class="tooltip tooltip-primary" data-tip="Notifikasi">
            <span class="fa fa-envelope"></span>
        </div>
    </a>
    <a href="{{ route('client.profile') }}" @class(['active' => Request::routeIs('client.profile')])>
        <div class="tooltip tooltip-primary" data-tip="Profil">
            <span class="fa fa-user"></span>
        </div>
    </a>
</div>

{{-- top navigation --}}
<div class="navbar bg-base-300 fixed z-20 py-3 md:px-7">
    <div class="flex-1">
        <a href="{{ route('client.home') }}" class="ml-2 sm:mr-2">
            <img src="{{ asset('assets/images/logo.webp') }}" alt="logo" width="60px" class="">
        </a>
        <div class="tooltip tooltip-primary tooltip-right"
            data-tip="Daftar Kategori">
            <div tabindex="0" role="button" class="btn btn-ghost outline-none text-lg"
                onclick="menuKategori.showModal()">
                <span class="fa fa-list"></span> <span class="hidden sm:inline">Kategori</span>
            </div>
        </div>
        @include('layouts.client.menu')
    </div>
    <div class="flex-none">
        {{-- searching --}}
        <div class="form-control hidden md:block mr-2">
            <input type="text" placeholder="Apa yang Anda cari ?" class="input input-bordered lg:w-96 w-auto" />
        </div>
        <button class="btn btn-ghost btn-circle md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>

        {{-- notifications --}}
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <div class="indicator">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="badge badge-xs badge-primary indicator-item"></span>
                </div>
            </div>
            <div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content w-52 bg-base-100 shadow">
                <div class="card-body gap-0">
                    <span class="font-bold text-lg mb-2">Notifikasi</span>
                    <span class="text-info py-1 px-2 bg-primary/5">Subtotal: $999</span>
                    <span class="text-info py-1 px-2 bg-primary/5">Subtotal: $999</span>
                    <span class="text-info py-1 px-2">Subtotal: $999</span>
                    <span class="text-info py-1 px-2">Subtotal: $999</span>
                    <span class="text-info py-1 px-2">Subtotal: $999</span>
                    <div class="card-actions mt-2">
                        <a href="{{ route('client.notification') }}" class="link mx-auto">Lihat semua</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- cart --}}
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <div class="indicator">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="badge badge-sm indicator-item">8</span>
                </div>
            </div>
            <div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content w-52 bg-base-100 shadow">
                <div class="card-body">
                    <span class="font-bold text-lg">8 Items</span>
                    <span class="text-info">Subtotal: $999</span>
                    <div class="card-actions">
                        <a href="{{ route('client.cart') }}" class="btn btn-primary btn-block">Buka cart</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- user icon --}}
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img alt="User profile photo"
                        src="{{ Storage::url('public/mocks/me.jpg') }}" />
                </div>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box">
                <div class="flex justify-evenly">
                    <button class="btn btn-ghost btn-circle">
                        <label class="swap swap-rotate">

                            <!-- this hidden checkbox controls the state -->
                            <input type="checkbox" class="themeSetter hidden" value="synthwave" />

                            <!-- sun icon -->
                            <svg class="swap-off fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
                            </svg>

                            <!-- moon icon -->
                            <svg class="swap-on fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
                            </svg>

                        </label>
                    </button>
                </div>
                <li><a href="{{ route('client.profile') }}" class="py-2"><span
                            class="fa fa-user"></span><span>Profil</span></a></li>
                <div class="divider my-0"></div>
                <li>
                    @if (auth()->check())
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="flex">
                            <span class="fa fa-person-running mr-2"></span><span>Keluar</span>
                        </button>
                    </form>
                    @else
                        <a href="{{ route('login') }}"><span>Masuk</span><span class="fa fa-right-to-bracket"></span></a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- bottom navigation --}}
<div class="btm-nav md:hidden bg-base-300 text-primary z-20 h-16">
    <a href="{{ route('client.home') }}" @class(['active' => Request::routeIs('client.home')])>
        <div class="tooltip tooltip-primary" data-tip="Halaman Utama">
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
    {{-- UNTUK PENAMBAHAN FITUR SELANJUTNYA DENGAN NOTIFIKASI --}}
    {{-- <a href="{{ route('client.notification') }}" @class(['active' => Request::routeIs('client.notification')])>
        <div class="tooltip tooltip-primary" data-tip="Notifikasi">
            <span class="fa fa-envelope"></span>
        </div>
    </a> --}}
    <a href="{{ route('client.profile') }}" @class(['active' => Request::routeIs('client.profile')])>
        <div class="tooltip tooltip-primary" data-tip="Profil">
            <span class="fa fa-user"></span>
        </div>
    </a>
</div>

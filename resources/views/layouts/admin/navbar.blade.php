<div class="navbar bg-base-300" id="navbar">
    <div>
        <div id="toggleSidebarBtn" role="button" class="btn btn-ghost btn-circle">
            <span id="burgerIcon" class="block">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-5 h-5 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </span>
            <span id="closeIcon" class="hidden text-primary text-2xl"><i class="fas fa-xmark"></i></span>
        </div>
        @include('layouts.admin.menu')
    </div>
    <div class="flex-1">
        <a class="btn btn-ghost text-lg" href="{{ route('client.home') }}" target="_blank">
            <span @class(['font-serif'])>DSComputer</span>
            <i class="fa fa-external-link text-sm"></i>
        </a>
    </div>
    <div class="flex-none">
        <button class="btn btn-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img alt="Tailwind CSS Navbar component"
                        src="{{ isset(auth()->user()->img) ? Storage::url(auth()->user()->img) : asset('assets/images/image-not-found.webp') }}"
                        />
                </div>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box">
                <div class="mx-auto">
                    @include('components_custom.dark-mode')
                </div>
                <li class="font-bold"><a>{{ auth()->user()->username }}</a></li>
                <div class="divider my-0"></div>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="flex">
                            <span class="fa fa-person-running mr-2"></span><span>Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

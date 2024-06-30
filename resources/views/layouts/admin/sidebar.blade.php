 {{-- SIDEBAR --}}
 <div id="sidebar"
     class="sidebar-hidden fixed inset-y-0 left-0 w-64 bg-base-300 text-base-content transition-transform duration-200 ease-in-out z-50 border-r border-r-secondary font-semibold">
     <div class="flex items-center justify-center h-20 bg-base text-base-content-content px-4">
         <h1>
             <img src="{{ asset('assets/images/logo.webp') }}" alt="logo" width="65px">
         </h1>
     </div>

     <nav class="mt-2 tracking-wide hover:[&_a]:bg-secondary hover:[&_a]:text-secondary-content ">
         <a href="{{ route('admin.dashboard') }}" @class([
             'block px-4 py-3 mt-0 text-sm',
             'bg-primary text-primary-content' => Request::routeIs('admin.dashboard'),
         ])>
             Dashboard
         </a>

         <a href="{{ route('admin.dashboard') }}" @class([
             'block px-4 py-3 mt-0 text-sm',
             // 'bg-primary text-primary-content' => Request::RouteIs('admin.dashboard') || Request::is('products/*'),
         ])>
             Produk
         </a>
         <a href="{{ route('notice.index') }}" @class([
             'block px-4 py-3 mt-0 text-sm',
             'bg-primary text-primary-content' =>
                 Request::RouteIs('notice.index'),
         ])>
             Notice
         </a>
         <a href="{{ route('faq.index') }}" @class([
             'block px-4 py-3 mt-0 text-sm',
             'bg-primary text-primary-content' =>
                 Request::RouteIs('faq.index') || Request::is('admin/faq/*'),
         ])>
             FAQ
         </a>
         <a href="{{ route('brand.index') }}" @class([
             'block px-4 py-3 mt-0 text-sm',
             'bg-primary text-primary-content' =>
                 Request::RouteIs('brand.index') || Request::is('admin/brand/*'),
         ])>
             Brand
         </a>
         <a href="{{ route('admin-member.index') }}" @class([
             'block px-4 py-3 mt-0 text-sm',
             'bg-primary text-primary-content' =>
                 Request::RouteIs('admin-member.index') || Request::is('admin/member/*'),
         ])>
             Member
         </a>
         <a href="{{ route('feature.index') }}" @class([
             'block px-4 py-3 mt-0 text-sm',
             'bg-primary text-primary-content' =>
                 Request::RouteIs('feature.index') || Request::is('admin/feature/*'),
         ])>
             Feature
         </a>
         <a href="{{ route('sosmed.index') }}" @class([
             'block px-4 py-3 mt-0 text-sm',
             'bg-primary text-primary-content' =>
                 Request::RouteIs('sosmed.index') || Request::is('admin/sosmed/*'),
         ])>
             Sosmed
         </a>
         <a href="{{ route('testimonial.index') }}" @class([
             'block px-4 py-3 mt-0 text-sm',
             'bg-primary text-primary-content' =>
                 Request::RouteIs('testimonial.index') || Request::is('admin/testimonial/*'),
         ])>
             Testimonial
         </a>

         {{-- MENU DENGAN SUBMENU --}}
         {{-- <div class="relative">
             <button id="masterBtn" class="block w-full text-left px-4 py-3 mt-0 text-sm focus:outline-none transition">
                 <div class="flex">
                     <span>Master</span>
                     <svg id="caretIconMaster" @class([
                         'ml-auto inline w-4 h-4 mr-2 transition-transform duration-200 transform',
                         'rotate-180' => Request::is('master/*'),
                     ]) fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                         </path>
                     </svg>
                 </div>
             </button>
             <div id="submenuMaster" @class([
                 'mt-0 [&>a]:pl-6 origin-top-left bg-base-100 shadow-lg z-20 submenuMaster',
                 'submenu-visible' => Request::is('master/*'),
             ])>
                 <a href="{{ route('kegiatan.index') }}" @class([
                     'block px-4 py-3 mt-0 text-sm',
                     'bg-primary text-primary-content' => Request::RouteIs('kegiatan.index') || Request::is('master/kegiatan/*'),
                 ])>Kegiatan</a>
                 <a href="{{ route('petugas.index') }}" @class([
                     'block px-4 py-3 mt-0 text-sm',
                     'bg-primary text-primary-content' => Request::RouteIs('petugas.index') || Request::is('master/petugas/*'),
                 ])>Petugas</a>
                 <a href="{{ route('wilayah.index') }}" @class([
                     'block px-4 py-3 mt-0 text-sm',
                     'bg-primary text-primary-content' => Request::RouteIs('wilayah.index') || Request::is('master/wilayah/*'),
                 ])>Wilayah</a>
             </div>
         </div> --}}
         {{-- MENU DENGAN SUBMENU END --}}

         <div class="divider divider-neutral mt-4 mb-1 text-xs">PENGATURAN</div>

         <a href="{{ route('admin-profile.index') }}" @class([
             'block px-4 py-3 mt-0 text-sm',
             'bg-primary text-primary-content' =>
                 Request::RouteIs('admin-profile.index') || Request::is('admin/profile/*'),
         ])>
             Profile
         </a>

         {{-- <a href="#" class="block px-4 py-3 mt-0 text-sm hover:bg-primary-content/20">Profil</a> --}}
     </nav>
 </div>

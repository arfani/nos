 {{-- SIDEBAR --}}
 <div id="sidebar"
     class="fixed inset-y-0 left-0 w-64 bg-base-300 text-base-content transition-transform duration-200 ease-in-out z-50 sidebar-hidden border-r border-r-primary-content">
     <div class="flex items-center justify-center bg-primary-content text-primary-content-content px-4 border-b border-b-gray-900">
         <h1 class="text-2xl font-semibold">
             <img src="{{ asset('assets/images/logo.webp') }}" alt="logo" width="70px" class="my-4">
         </h1>
     </div>
     <nav class="mt-0 tracking-wide">
         <a href="{{ route('admin.dashboard') }}"
             class="block px-4 py-3 mt-0 text-sm font-semibold text-white bg-primary-content/60 hover:bg-primary-content/20">Dasbor</a>

         {{-- MENU DENGAN SUBMENU --}}
         <div class="relative">
             <button id="masterBtn"
                 class="block w-full text-left px-4 py-3 mt-0 text-sm font-semibold text-white hover:bg-primary-content/20 focus:outline-none focus:bg-primary-content/30 transition">
                 <div class="flex">
                     <span>Master</span>
                     <svg id="caretIconMaster"
                         class="ml-auto inline w-4 h-4 mr-2 transition-transform duration-200 transform" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                         </path>
                     </svg>
                 </div>
             </button>
             <div id="submenuMaster" class="mt-0 [&>a]:pl-6 origin-top-left bg-base-200 shadow-lg z-20 submenuMaster">
                 <a href="#"
                     class="block px-4 py-3 mt-0 text-sm font-semibold text-white hover:bg-primary-content/20">Kegiatan</a>
                 <a href="#settings/submenu2"
                     class="block px-4 py-3 mt-0 text-sm font-semibold text-white hover:bg-primary-content/20">Peteugas</a>
                 <a href="#settings/submenu3"
                     class="block px-4 py-3 mt-0 text-sm font-semibold text-white hover:bg-primary-content/20">Wilayah</a>
             </div>
         </div>
         {{-- MENU DENGAN SUBMENU END --}}

         <a href="#"
             class="block px-4 py-3 mt-0 text-sm font-semibold text-white hover:bg-primary-content/20">Surat Tugas</a>
         <a href="#"
             class="block px-4 py-3 mt-0 text-sm font-semibold text-white hover:bg-primary-content/20">Biaya Perjalanan
             Dinas</a>
         <a href="#"
             class="block px-4 py-3 mt-0 text-sm font-semibold text-white hover:bg-primary-content/20">Kwitansi</a>
         <a href="#"
             class="block px-4 py-3 mt-0 text-sm font-semibold text-white hover:bg-primary-content/20">SPD</a>

         <div class="divider divider-neutral my-0 text-xs font-semibold">PENGATURAN</div>

         <a href="#"
             class="block px-4 py-3 mt-0 text-sm font-semibold text-white hover:bg-primary-content/20">Profil</a>
     </nav>
 </div>

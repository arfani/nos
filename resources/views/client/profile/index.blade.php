<x-client-layout>
    <div class="flex flex-col sm:flex-row items-center sm:items-start p-4 gap-8 sm:gap-2">
        {{-- LEFT SIDE --}}
        <div class="card w-80 bg-base-200 shadow-xl">
            <figure class="px-10 pt-10 pb-2">
                <div class="avatar">
                    <div class="w-full rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                        <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                    </div>
                </div>
            </figure>
            <div class="card-body items-center text-center">
                <h2 class="card-title">Fulan bin Fulan</h2>
                <p>Your Status here !</p>
                <div class="card-actions">
                    <button class="btn btn-primary btn-sm"><i class="fas fa-pencil"></i></button>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="flex-1 bg-base-200 shadow-xl card">
            <div x-data="{ activeTab: 1 }">
                <div class="flex bg-base-300 rounded-t-2xl">
                    <button class="uppercase px-8 py-3 -mb-px text-sm rounded-t-2xl"
                        :class="activeTab === 1 ? 'border-base-200 bg-base-200' : 'text-gray-600'"
                        @click="activeTab = 1">
                        Biodata
                    </button>
                    <button class="uppercase px-8 py-3 -mb-px text-sm rounded-t-2xl"
                        :class="activeTab === 2 ? 'border-base-200 bg-base-200' : 'text-gray-600'"
                        @click="activeTab = 2">
                        Daftar Alamat
                    </button>
                </div>

                <!-- Tab Contents -->
                <div class="p-6 bg-base-200 rounded text-sm">
                    <div x-show="activeTab === 1">
                        <h2 class="font-bold uppercase mb-2">Data Diri</h2>

                        <div class="flex gap-2 leading-10">
                            <span class="opacity-75">Nama Lengkap :</span><span>Fulan bin Fulan bin Abdillah</span>
                        </div>

                        <div class="flex gap-2 leading-10">
                            <span class="opacity-75">Nama Panggilan :</span><span>Abdullah</span>
                        </div>

                        <div class="flex gap-2 leading-10">
                            <span class="opacity-75">Tanggal Lahir :</span><span>3 Mei 1993</span>
                        </div>

                        <div class="flex gap-2 leading-10">
                            <span class="opacity-75">Jenis Kelamin :</span><span>L</span>
                        </div>

                        <div class="flex gap-2 leading-10">
                            <span class="opacity-75">Status Pernikahan :</span><span>Menikah</span>
                        </div>

                        <div class="flex gap-2 leading-10">
                            <span class="opacity-75">Pekerjaan :</span><span>Pengusaha</span>
                        </div>

                        <div class="flex gap-2 leading-10">
                            <span class="opacity-75">Pendidikan :</span><span>S1</span>
                        </div>

                        <h2 class="font-bold uppercase mb-2 mt-4">Kontak</h2>

                        <div class="flex gap-2 leading-10">
                            <span class="opacity-75">Nomor HP :</span><span>081907456710</span>
                        </div>

                        <div class="flex gap-2 leading-10">
                            <span class="opacity-75">Email :</span><span>Abdullah@mail.com</span>
                        </div>

                        <div class="others mt-4"></div>
                        
                        <div class="flex items-center">
                            <div class="flex gap-2 leading-10 opacity-50">
                                <span>Tanggal bergabung :</span><span>3 Januari 2000</span>
                            </div>
                            <button class="btn btn-primary ml-auto btn-sm"><i class="fas fa-pencil"></i></button>
                        </div>
                    </div>
                    <div x-show="activeTab === 2">
                        <button class="btn btn-primary mb-4 btn-sm"><i class="fas fa-plus"></i> Tambah</button>

                        <div class="alamat bg-base-300 p-4 rounded mb-3 shadow-lg">
                            <h2 class="font-bold text-base mb-2">Rumah <span
                                    class="badge badge-primary badge-xs badge-outline p-2">utama</span></h2>
                            <address>Jalan Beo No. 22 Karang Kemong, Cakranegara Barat, Mataram, Lombok, NTB.</address>
                            <p>( Pas Gapura Masjid Nurul Yaqin Karang Kemong )</p>

                            <div class="flex gap-2 leading-relaxed mt-2">
                                <span class="opacity-75">Penerima :</span><span>Abdullah</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex gap-2">
                                    <span class="opacity-75">HP :</span><span>081907456710</span>
                                </div>
                                <button class="btn btn-primary ml-auto btn-sm"><i class="fas fa-pencil"></i></button>
                            </div>
                        </div>

                        <div class="alamat bg-base-300 p-4 rounded mb-3 shadow-lg">
                            <h2 class="font-bold text-base mb-2">Kantor</h2>
                            <address>Jalan Beo No. 22 Karang Kemong, Cakranegara Barat, Mataram, Lombok, NTB.
                            </address>
                            <p>( Pas Gapura Masjid Nurul Yaqin Karang Kemong )</p>

                            <div class="flex gap-2 leading-relaxed mt-2">
                                <span class="opacity-75">Penerima :</span><span>Abdullah</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex gap-2">
                                    <span class="opacity-75">HP :</span><span>081907456710</span>
                                </div>
                                <div class="ml-auto">
                                    <button class="btn btn-error btn-sm"><i class="fas fa-trash"></i></button>
                                    <button class="btn btn-primary btn-sm"><i class="fas fa-pencil"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-client-layout>

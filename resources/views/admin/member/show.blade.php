<x-app-layout>
    <div class="sm:mx-6 lg:mx-8 p-6 py-10 bg-secondary text-secondary-content rounded overflow-x-auto">
        <div class="flex flex-col sm:flex-row items-center sm:items-start p-4 gap-8 sm:gap-2">
            {{-- LEFT SIDE --}}
            <div class="card w-80 bg-base-200 shadow-xl">
                <figure class="px-10 pt-10 pb-2">
                    <div class="avatar">
                        <div class="w-full rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img src="{{ isset($data->img) ? Storage::url($data->img) : asset('assets/images/image-not-found.webp') }}"
                                alt="profile picture" />
                        </div>
                    </div>
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">{{ $data->fullname }}</h2>
                    <p>{{ $data->status }}</p>
                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="flex-1 bg-base-200 shadow-xl card">
                <div x-data="{ activeTab: 1 }">
                    <div class="flex bg-base-300 rounded-t-2xl">
                        <button class="uppercase px-8 py-3 -mb-px text-sm rounded-t-2xl"
                            :class="activeTab === 1 ? 'border-base-200 bg-base-200' : 'text-gray-600'"
                            @click="activeTab = 1">
                            DATA MEMBER
                        </button>
                    </div>

                    <!-- Tab Contents -->
                    <div class="p-6 bg-base-200 rounded text-sm">
                        <div x-show="activeTab === 1">
                            <h2 class="font-bold uppercase mb-2">Data Diri</h2>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Nama Lengkap :</span><span>{{ $data->fullname }}</span>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Nama Panggilan :</span><span>{{ $data->name }}</span>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Tanggal Lahir
                                    :</span><span>{{ $data->birthday ? $data->birthday->isoFormat('LL') : '-' }}</span>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Jenis Kelamin :</span><span>
                                    @if ($data->gender === 'm')
                                        Laki
                                    @elseif ($data->gender === 'f')
                                        Perempuan
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Status Pernikahan
                                    :</span><span>{{ $data['status-pernikahan'] }}</span>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Pekerjaan :</span><span>{{ $data->occupation }}</span>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Pendidikan :</span><span>{{ $data->education }}</span>
                            </div>

                            <h2 class="font-bold uppercase mb-2 mt-4">Kontak</h2>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Nomor HP :</span><span>{{ $data->hp }}</span>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Email :</span><span>{{ $data->email }}</span>
                            </div>

                            <div class="others mt-4"></div>

                            <div class="flex items-center">
                                <div class="flex gap-2 leading-10 opacity-50">
                                    <span>Tanggal bergabung
                                        :</span><span>{{ $data->created_at->isoFormat('LL') }}</span>
                                </div>
                            </div>

                            <a href="{{ route('admin-member.index') }}"
                                class="py-2 px-4 bg-gray-500 text-gray-50 text-center mt-6 rounded inline-block">{{ __('Kembali') }}</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

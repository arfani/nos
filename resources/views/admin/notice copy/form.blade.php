<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-secondary text-secondary-content overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-xl uppercase mb-4 font-bold">{{isset($data) ? 'Ubah' : 'Tambah'}} Data {{__('Kegiatan')}}</h2>
                    @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-700 rounded-lg bg-red-300 dark:bg-gray-800 dark:text-red-400 w-fit" role="alert">
                        @foreach ($errors->all() as $error)
                        <span class="font-medium block"><i class="fas fa-circle-exclamation mr-2"></i>{{$error}}</span>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{isset($data) ? route('kegiatan.update', $data) : route('kegiatan.store')}}" method="POST" id="main">
                        @csrf

                        @isset($data)
                        @method('PUT')
                        @endisset
                        <div class="form-container flex flex-col">
                            <div class="form-content grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

                                <div class="flex flex-col mb-4">
                                    <label for="kegiatan">Nama</label>
                                    <input type="text" id="kegiatan" name="kegiatan" class="my-input bg-primary/5 rounded w-fit border-transparent border-b border-b-primary 
            focus:ring-transparent focus:border-transparent focus:border-b-primary" value="{{old('kegiatan', isset($data) ? $data->kegiatan : '')}}" required autofocus>
                                </div>

                                <div class="flex flex-col mb-4">
                                    <label for="mak">MAK</label>
                                    <input type="text" id="mak" name="mak" class="my-input bg-primary/5 rounded w-fit border-transparent border-b border-b-primary 
            focus:ring-transparent focus:border-transparent focus:border-b-primary" value="{{old('mak', isset($data) ? $data->mak : '')}}" required>
                                </div>

                                <div class="flex flex-col mb-4">
                                    <label for="maksud_tugas" class="font-semibold">Maksud Tugas</label>
                                    <textarea name="maksud_tugas" id="maksud_tugas" rows="3" class="my-input bg-primary/5 rounded">{{old('maksud_tugas', isset($data) ? $data->maksud_tugas : '')}}</textarea>
                                </div>

                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{route('kegiatan.index')}}" class="py-2 px-4 bg-gray-500 text-gray-50 text-center mt-6 rounded">{{__('Kembali')}}</a>
                                <button type="submit" class="py-2 px-4 bg-primary text-primary-content mt-6 rounded">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        (function() {
            const form = document.querySelector('form#main')
            const submitBtn = document.querySelector('button[type="submit"]')

            form.addEventListener('submit', function() {
                submitBtn.setAttribute('disabled', true)
            })
        })()
    </script>

    @endpush
</x-app-layout>
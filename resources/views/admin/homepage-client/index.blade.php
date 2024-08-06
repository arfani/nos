<x-app-layout>
    <div class="sm:mx-6 lg:mx-8 p-6 py-10 bg-secondary text-secondary-content rounded overflow-x-auto">
        @if (Session::get('success'))
            <div x-data="{ show: true }" x-show="show" x-transition:leave.duration.500ms x-init="setTimeout(() => show = false, 5000)"
                class="toast toast-top toast-end mt-10">
                <div role="alert" class="alert alert-success mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ Session::get('success') }}</span>
                </div>
            </div>
        @endif

        <form action="{{ route('homepage-client.update', $hero->section_name) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-container flex flex-col">

                <div class="flex flex-col mb-4">
                    <label for="title" class="font-semibold mb-2">Judul</label>
                    <input type="text" id="title" name="title" class="my-input bg-primary/5 rounded"
                        value="{{ old('title', $hero->title) }}" required>
                </div>

                <div class="flex flex-col mb-4">
                    <label for="description" class="font-semibold mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" class="my-input bg-primary/5 rounded">{{ old('description', $hero->description) }}</textarea>
                </div>

                <div class="flex flex-col mb-4 tooltip"
                    data-tip="Jumlah gambar barang yang ingin ditampilkan pada Hero">
                    <label for="show_items" class="font-semibold mb-2 text-left">Jumlah tampil</label>
                    <input type="number" id="show_items" name="show_items" class="my-input bg-primary/5 rounded w-fit"
                        max="100" value="{{ old('show_items', $hero->show_items ?? 0) }}">
                </div>

                <div class="flex gap-1 items-center mb-4 tooltip" data-tip="Tampilkan atau sembunyikan bagian Hero">
                    <input type="hidden" name="is_show" id="is_show" value="0">
                    <input type="checkbox" name="is_show" id="is_show" value="1" {{ $hero->is_show ? 'checked' : '' }} />
                    <label for="is_show" class="font-semibold">Tampilkan</label>
                </div>

                <button type="submit" class="py-2 px-4 bg-primary text-primary-content rounded">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>

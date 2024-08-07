
<div class="sm:mx-6 lg:mx-8 p-6 py-10 bg-base-300 text-base-content rounded overflow-x-auto">
    <div class="text-center mb-6">
        <h1 class="text-2xl sm:text-4xl font-bold capitalize">{{ $section->section_name }}</h1>
    </div>
    <form action="{{ route('homepage-client.update', $section->section_name) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-container flex flex-col">

            <div class="flex flex-col mb-4">
                <label for="title" class="font-semibold mb-2">Judul</label>
                <input type="text" id="title" name="title" class="my-input bg-primary/5 rounded"
                    value="{{ old('title', $section->title) }}" required>
            </div>

            <div class="flex flex-col mb-4">
                <label for="description" class="font-semibold mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="3" class="my-input bg-primary/5 rounded">{{ old('description', $section->description) }}</textarea>
            </div>

            <div class="flex flex-col mb-4 tooltip"
                data-tip="Jumlah gambar barang yang ingin ditampilkan pada Hero">
                <label for="show_items" class="font-semibold mb-2 text-left">Jumlah tampil</label>
                <input type="number" id="show_items" name="show_items" class="my-input bg-primary/5 rounded w-fit"
                    min="1" max="100" value="{{ old('show_items', $section->show_items ?? 0) }}">
            </div>

            <div class="flex gap-1 items-center mb-4 tooltip" data-tip="Tampilkan atau sembunyikan bagian Hero">
                <input type="hidden" name="is_show" id="is_show" value="0">
                <input type="checkbox" name="is_show" id="is_show" value="1"
                    {{ $section->is_show ? 'checked' : '' }} />
                <label for="is_show" class="font-semibold">Tampilkan</label>
            </div>

            <button type="submit" class="py-2 px-4 bg-primary text-primary-content rounded">Simpan</button>
        </div>
    </form>
</div>
<x-app-layout>
    <div class="sm:mx-6 lg:mx-8 p-6 py-10 rounded overflow-x-auto">
        <form action="{{ route('notice.update', $notice) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-container flex flex-col">
                <div class="flex flex-col mb-4">
                    <label for="message" class="font-semibold mb-2">Pesan</label>
                    <textarea name="message" id="message" rows="3" class="my-input bg-primary/5 rounded">{{ old('message', $notice->message) }}</textarea>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="link" class="font-semibold mb-2">Link</label>
                    <input type="text" id="link" name="link" class="my-input bg-primary/5 rounded "
                        value="{{ old('link', $notice->link) }}" required>
                </div>
                <button type="submit" class="py-2 px-4 bg-primary text-primary-content rounded">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>

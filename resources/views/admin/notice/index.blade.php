<x-app-layout>
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
                <input type="text" id="link" name="link" class="my-input bg-primary/5 rounded " value="{{ old('link', $notice->link) }}" required>
            </div>


            <button type="submit" class="py-2 px-4 bg-primary text-primary-content rounded">Simpan</button>
        </div>
    </form>
</x-app-layout>

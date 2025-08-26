<dialog id="menuKategori" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
        <h3 class="font-bold text-xl md:text-2xl mb-2">Kategori</h3>
        <div class="flex flex-col items-start">
            {{-- @foreach ($categories as $item)
                <a href="{{ route('client.productsByCategory', $item->name) }}" class="btn btn-ghost">
                    {{ $item->name }}
                </a>
            @endforeach --}}
            @foreach ($category_labels as $label)
            <div>
                <p class="font-semibold text-lg text-gray-500">{{ $label->name }}</p>
                <div class="ml-4 flex flex-col">
                    @foreach ($label->categories as $item)
                        <a href="{{ route('client.productsByCategory', $item->name) }}" 
                           class="btn btn-ghost justify-start">
                            {{ $item->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

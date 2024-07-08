<dialog id="menuKategori" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
        <h3 class="font-bold text-xl md:text-2xl mb-2 text-center">Kategori</h3>
        <div class="flex justify-center flex-wrap">
            @foreach ($categories as $item)
            <a href="{{ route('client.productsByCategory', $item->name) }}" class="btn btn-ghost">
                {{ $item->name }}
            </a>
            @endforeach
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-secondary text-secondary-content overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 [&>div]:mb-2">
                <h2 class="text-2xl uppercase mb-4">Data <b>{{ $data->name }}</b></h2>

                <div>Nama : <strong>{{ $data->name }}</strong></div>
                <div>Stok : <strong>{{ $data->stock }}</strong></div>
                <div>Harga : <strong><x-client.format-rp :value="$data->price" /></strong></div>

                <a href="{{ route('product.index') }}"
                    class="py-2 px-4 bg-gray-500 text-gray-50 text-center mt-6 rounded inline-block">{{ __('Kembali') }}</a>
            </div>
        </div>
    </div>
</x-app-layout>

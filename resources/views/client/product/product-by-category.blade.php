<x-client-layout>
    <h2 class="text-center text-3xl uppercase font-bold tracking-wider">{{ __('Produk ') . '"' . $category . '"' }}</h2>
    <p class="text-center mb-8 mt-2">
        {{ __('Halaman ini hanya menampilkan produk dengan kategori ')}} <strong>"{{ $category }}"</strong></p>
    <div class="flex flex-wrap justify-around">
        @foreach ($products as $product)
            <x-client.product-item :product="$product" />
        @endforeach
    </div>

    <div class="w-full text-center my-2">
        <a href="" class="btn btn-primary btn-ghost tracking-wider">Lainnya</a>
    </div>

    <x-client.features />
</x-client-layout>

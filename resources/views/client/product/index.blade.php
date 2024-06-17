<x-client-layout>
    <h2 class="text-center mb-10 text-3xl uppercase font-bold tracking-wider">PRODUK KAMI</h2>

    <div class="flex flex-wrap justify-around">

        <x-client.product-item :url="route('client.product', 'test')" :img="Storage::url('public/mocks/a.jpg')" :promo="true" />
        <x-client.product-item :url="route('client.product', 'test')" :img="Storage::url('public/mocks/b.jpg')" />
        <x-client.product-item :url="route('client.product', 'test')" :img="Storage::url('public/mocks/c.jpg')" :lelang="true" :endtime="now()->addDays(3)" />
        <x-client.product-item :url="route('client.product', 'test')" :img="Storage::url('public/mocks/d.jpg')" :promo="true" />
        <x-client.product-item :url="route('client.product', 'test')" :img="Storage::url('public/mocks/e.jpg')" :promo="true" />
        <x-client.product-item :url="route('client.product', 'test')" :img="Storage::url('public/mocks/f.jpg')" :lelang="true" :endtime="now()->addDays(6)" />
    </div>

    <div class="w-full text-center my-2">
        <a href="" class="btn btn-primary btn-ghost tracking-wider">Lainnya</a>
    </div>
</x-client-layout>

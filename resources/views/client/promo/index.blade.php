<x-client-layout>
    <h2 class="text-center mb-10 text-3xl uppercase font-bold tracking-wider">SPESIAL PROMO <i
            class="fa fa-tags text-red-500 text-2xl pb-1"></i></h2>

    <div class="flex flex-wrap justify-around">
        <x-client.product-item :img="Storage::url('public/mocks/a.jpg')" :promo="true" />
        <x-client.product-item :img="Storage::url('public/mocks/b.jpg')" :promo="true" />
        <x-client.product-item :img="Storage::url('public/mocks/c.jpg')" :promo="true" />
        <x-client.product-item :img="Storage::url('public/mocks/d.jpg')" :promo="true" />
        <x-client.product-item :img="Storage::url('public/mocks/e.jpg')" :promo="true" />
        <x-client.product-item :img="Storage::url('public/mocks/f.jpg')" :promo="true" />
        <x-client.product-item :img="Storage::url('public/mocks/b.jpg')" :promo="true" />
        <x-client.product-item :img="Storage::url('public/mocks/d.jpg')" :promo="true" />
        <x-client.product-item :img="Storage::url('public/mocks/c.jpg')" :promo="true" />
    </div>

    <div class="w-full text-center my-2">
        <a href="" class="btn btn-primary btn-ghost tracking-wider">Lainnya</a>
    </div>

    <x-client.features />
</x-client-layout>

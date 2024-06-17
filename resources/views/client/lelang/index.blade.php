<x-client-layout>
    <h2 class="text-center mb-10 text-3xl uppercase font-bold tracking-wider">BARANG LELANG <i
            class="fa fa-hammer fa-flip-horizontal text-blue-500 text-2xl pb-1"></i></h2>

    <div class="flex flex-wrap justify-around">
        <x-client.product-item :img="Storage::url('public/mocks/a.jpg')" :lelang="true" :endtime="now()->addDays(1)" />
        <x-client.product-item :img="Storage::url('public/mocks/b.jpg')" :lelang="true" :endtime="now()->addDays(2)" />
        <x-client.product-item :img="Storage::url('public/mocks/c.jpg')" :lelang="true" :endtime="now()->addDays(3)" />
        <x-client.product-item :img="Storage::url('public/mocks/d.jpg')" :lelang="true" :endtime="now()->addDays(4)" />
        <x-client.product-item :img="Storage::url('public/mocks/e.jpg')" :lelang="true" :endtime="now()->addDays(5)" />
        <x-client.product-item :img="Storage::url('public/mocks/f.jpg')" :lelang="true" :endtime="now()->addDays(6)" />
    </div>

    <div class="w-full text-center my-2">
        <a href="" class="btn btn-primary btn-ghost tracking-wider">Lainnya</a>
    </div>

    <x-client.features />
</x-client-layout>

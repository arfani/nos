<x-client-layout>
    <h2 class="text-center text-3xl uppercase font-bold tracking-wider">
        {{ $auction['data']->title }} <i class="fa fa-hammer fa-flip-horizontal text-blue-500 text-2xl pb-1"></i>
    </h2>
    <p class="mt-2 mb-8 text-center">
        {{ $auction['data']->description }}
    </p>
    <div class="flex flex-wrap justify-around">
        @foreach ($auction['items'] as $auction)
            <x-client.product-item :product="$auction->product" />
        @endforeach
    </div>

    <div class="w-full text-center my-2">
        <a href="" class="btn btn-primary btn-ghost tracking-wider">Lainnya</a>
    </div>

    <x-client.features />
</x-client-layout>

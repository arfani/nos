{{-- @props([
    'products' => [
        [
            'name' => 'Product test 2',
            'slug' => 'product_test_2',
            'img' => Storage::url('mocks/a.jpg'),
            'price' => 10000,
            'promo' => [
                'active' => true,
                'discount' => 20,
            ],
            'variants' => true,
            'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
            'description' => 'lorem ipsum lorem amet ipsum',
            'stock' => 200,
            'lelang' => [
                'active' => false,
                'endtime' => now()->addDays(3),
                'bidStart' => 100000,
                'bidIncrement' => 5000,
                'ketentuan' => 'lorem ipsum dolor amet set',
            ],
        ],
        [
            'name' => 'Product test 2',
            'slug' => 'product_test_2',
            'img' => Storage::url('mocks/b.jpg'),
            'price' => 10000,
            'promo' => [
                'active' => true,
                'discount' => 20,
            ],
            'variants' => true,
            'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
            'description' => 'lorem ipsum lorem amet ipsum',
            'stock' => 200,
            'lelang' => [
                'active' => false,
                'endtime' => now()->addDays(3),
                'bidStart' => 100000,
                'bidIncrement' => 5000,
                'ketentuan' => 'lorem ipsum dolor amet set',
            ],
        ],
        [
            'name' => 'Product test 2',
            'slug' => 'product_test_2',
            'img' => Storage::url('mocks/c.jpg'),
            'price' => 10000,
            'promo' => [
                'active' => true,
                'discount' => 20,
            ],
            'variants' => true,
            'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
            'description' => 'lorem ipsum lorem amet ipsum',
            'stock' => 200,
            'lelang' => [
                'active' => false,
                'endtime' => now()->addDays(3),
                'bidStart' => 100000,
                'bidIncrement' => 5000,
                'ketentuan' => 'lorem ipsum dolor amet set',
            ],
        ],
        [
            'name' => 'Product test 2',
            'slug' => 'product_test_2',
            'img' => Storage::url('mocks/d.jpg'),
            'price' => 10000,
            'promo' => [
                'active' => true,
                'discount' => 20,
            ],
            'variants' => true,
            'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
            'description' => 'lorem ipsum lorem amet ipsum',
            'stock' => 200,
            'lelang' => [
                'active' => false,
                'endtime' => now()->addDays(3),
                'bidStart' => 100000,
                'bidIncrement' => 5000,
                'ketentuan' => 'lorem ipsum dolor amet set',
            ],
        ],
        [
            'name' => 'Product test 2',
            'slug' => 'product_test_2',
            'img' => Storage::url('mocks/e.jpg'),
            'price' => 10000,
            'promo' => [
                'active' => true,
                'discount' => 20,
            ],
            'variants' => true,
            'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
            'description' => 'lorem ipsum lorem amet ipsum',
            'stock' => 200,
            'lelang' => [
                'active' => false,
                'endtime' => now()->addDays(3),
                'bidStart' => 100000,
                'bidIncrement' => 5000,
                'ketentuan' => 'lorem ipsum dolor amet set',
            ],
        ],
        [
            'name' => 'Product test 2',
            'slug' => 'product_test_2',
            'img' => Storage::url('mocks/f.jpg'),
            'price' => 10000,
            'promo' => [
                'active' => true,
                'discount' => 20,
            ],
            'variants' => true,
            'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
            'description' => 'lorem ipsum lorem amet ipsum',
            'stock' => 200,
            'lelang' => [
                'active' => false,
                'endtime' => now()->addDays(3),
                'bidStart' => 100000,
                'bidIncrement' => 5000,
                'ketentuan' => 'lorem ipsum dolor amet set',
            ],
        ],
    ],
]) --}}

<x-client-layout>
    <h2 class="text-center text-3xl uppercase font-bold tracking-wider">
        {{ $promo['data']->title }} <i class="fa fa-tags text-red-500 text-2xl pb-1"></i>
    </h2>
    <p class="text-center pt-2 mb-8">{{ $promo['data']->description }}</p>

    <div class="flex flex-wrap justify-around">
        @foreach ($promo['items'] as $product)
            <x-client.product-item :product="$product" />
        @endforeach
    </div>

    <div class="w-full text-center my-2">
        <a href="" class="btn btn-primary btn-ghost tracking-wider">Lainnya</a>
    </div>

    <x-client.features />
</x-client-layout>

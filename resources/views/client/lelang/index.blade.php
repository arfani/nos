@props([
    'products' =>
    [[
        'name' => 'Product test 3',
        'slug' => 'product_test_3',
        'img' => Storage::url('mocks/a.jpg'),
        'price' => 10000,
        'promo' => [
            'active' => false,
            'discount' => 20,
        ],
        'variants' => true,
        'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
        'description' => 'lorem ipsum lorem amet ipsum',
        'stock' => 200,
        'lelang' => [
            'active' => true,
            'endtime' => now()->addDays(3),
            'bidStart' => 100000,
            'bidIncrement' => 5000,
            'ketentuan' => 'lorem ipsum dolor amet set',
        ],
    ],[
        'name' => 'Product test 3',
        'slug' => 'product_test_3',
        'img' => Storage::url('mocks/b.jpg'),
        'price' => 10000,
        'promo' => [
            'active' => false,
            'discount' => 20,
        ],
        'variants' => true,
        'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
        'description' => 'lorem ipsum lorem amet ipsum',
        'stock' => 200,
        'lelang' => [
            'active' => true,
            'endtime' => now()->addDays(3),
            'bidStart' => 100000,
            'bidIncrement' => 5000,
            'ketentuan' => 'lorem ipsum dolor amet set',
        ],
    ],[
        'name' => 'Product test 3',
        'slug' => 'product_test_3',
        'img' => Storage::url('mocks/c.jpg'),
        'price' => 10000,
        'promo' => [
            'active' => false,
            'discount' => 20,
        ],
        'variants' => true,
        'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
        'description' => 'lorem ipsum lorem amet ipsum',
        'stock' => 200,
        'lelang' => [
            'active' => true,
            'endtime' => now()->addDays(3),
            'bidStart' => 100000,
            'bidIncrement' => 5000,
            'ketentuan' => 'lorem ipsum dolor amet set',
        ],
    ],[
        'name' => 'Product test 3',
        'slug' => 'product_test_3',
        'img' => Storage::url('mocks/d.jpg'),
        'price' => 10000,
        'promo' => [
            'active' => false,
            'discount' => 20,
        ],
        'variants' => true,
        'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
        'description' => 'lorem ipsum lorem amet ipsum',
        'stock' => 200,
        'lelang' => [
            'active' => true,
            'endtime' => now()->addDays(3),
            'bidStart' => 100000,
            'bidIncrement' => 5000,
            'ketentuan' => 'lorem ipsum dolor amet set',
        ],
    ],[
        'name' => 'Product test 3',
        'slug' => 'product_test_3',
        'img' => Storage::url('mocks/e.jpg'),
        'price' => 10000,
        'promo' => [
            'active' => false,
            'discount' => 20,
        ],
        'variants' => true,
        'detail' => [['name' => 'Berat', 'value' => '2 Kg'], ['name' => 'Kondisi', 'value' => 'Second Hand']],
        'description' => 'lorem ipsum lorem amet ipsum',
        'stock' => 200,
        'lelang' => [
            'active' => true,
            'endtime' => now()->addDays(3),
            'bidStart' => 100000,
            'bidIncrement' => 5000,
            'ketentuan' => 'lorem ipsum dolor amet set',
        ],
    ],]
])

<x-client-layout :sosmed="$sosmed">
    <h2 class="text-center mb-10 text-3xl uppercase font-bold tracking-wider">BARANG LELANG <i
            class="fa fa-hammer fa-flip-horizontal text-blue-500 text-2xl pb-1"></i></h2>

    <div class="flex flex-wrap justify-around">
        @foreach ($products as $item)
        <x-client.product-item :product="$item" />
        @endforeach
    </div>

    <div class="w-full text-center my-2">
        <a href="" class="btn btn-primary btn-ghost tracking-wider">Lainnya</a>
    </div>

    <x-client.features :features="$features" />
</x-client-layout>

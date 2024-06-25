@props(['product' => [
        'name' => 'Product test 1',
        'slug' => 'product_test_1',
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
            'ketentuan' => 'lorem ipsum dolor amet set'
        ]
        ]])

<x-client-layout>
    <x-client.product-detail :product="$product" />

    <x-client.features />
    @push('scripts')
        @vite(['resources/css/client/detail-product.css', 'resources/js/client/detail-product.js'])
    @endpush
</x-client-layout>

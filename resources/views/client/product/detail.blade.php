<x-client-layout>
    <x-client.product-detail :product="$product" />

    <x-client.features />
    @push('scripts')
        @vite(['resources/css/client/detail-product.css', 'resources/js/client/detail-product.js'])
    @endpush
</x-client-layout>

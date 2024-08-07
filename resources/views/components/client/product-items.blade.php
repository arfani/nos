@foreach ($products as $product)
    <x-client.product-item :product="$product" />
@endforeach

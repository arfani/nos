<div class="card w-72 bg-base-200 shadow-xl mb-8" x-data>
    <figure class="px-10 pt-10 relative">
        <a href="{{ route('client.product', $product['slug']) }}">
            @if ($product->product_pictures->isNotEmpty())
                <img src="{{ Storage::url($product->product_pictures->first()->path) }}" alt="{{ $product->name }}"
                    class="rounded-xl" />
            @else
                <img src="{{ '/assets/images/image-not-found.webp' }}" alt="{{ $product->name }}" class="rounded-xl" />
            @endif
        </a>

        @if (isset($product->auction) && $product->auction->active)
            <x-client.logo-lelang :endtime="$product->auction->endtime" />
        @elseif (isset($product->promo) && $product->promo->active)
            <x-client.logo-promo />
        @endif
    </figure>
    <div class="card-body items-center text-center">
        <a href="{{ route('client.product', $product['slug']) }}">
            <h2 class="card-title">{{ $product->name }}</h2>
        </a>
        @if (count($product->product_variant) > 1)
            <div class="variant">
                <select name="variant" class="my-input" x-ref="variant_id_selected">
                    @foreach ($product->product_variant as $variant)
                        <option value="{{ $variant->id }}">
                            @foreach ($variant->product_detail as $i => $variant_detail)
                                @if ($i !== 0)
                                    {{ '& ' . $variant_detail->variant_value->variant->variant }} -
                                    {{ $variant_detail->variant_value->value }}
                                @else
                                    {{ $variant_detail->variant_value->variant->variant }} -
                                    {{ $variant_detail->variant_value->value }}
                                @endif
                            @endforeach
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        <p>{!! Str::limit($product->description, 50, '...') !!}</p>
        <div class="card-actions">
            <div class="flex flex-col items-center gap-4">
                <div>
                    @if (count($product->product_variant) > 1)
                        <x-client.format-rp :value="$product->product_variant[0]->price" /> - <x-client.format-rp :value="$product->product_variant[count($product->product_variant) - 1]->price" />
                    @else
                        <x-client.format-rp :value="$product->product_variant[0]->price" />
                    @endif
                </div>
                <div class="flex">
                    <input type="number" name="quantity" x-ref="quantity" class="my-input px-1 w-16" min="1" value="1">
                    <div class="tooltip tooltip-bottom" data-tip="Tambah ke keranjang">
                        <button
                            @click="$store.cart.addToCart('{{ $product->id }}', $refs.variant_id_selected ? $refs.variant_id_selected.value : null, $refs.quantity.value)"
                            class="btn btn-circle btn-ghost"><i class="fa fa-opencart"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

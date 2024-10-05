<div class="card sm:w-72 bg-base-200 shadow-xl mb-8 h-fit" x-data>
    <figure class="sm:px-5 sm:pt-5 relative">
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
            <h2 class="card-title text-lg">{{ $product->name }}</h2>
        </a>
        @if (count($product->product_variant) > 1)
        <div class="variant w-full overflow-auto">
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

        @can('is-member')
        {{-- HARGA PRODUK HANYA BISA DILIHAT OLEH MEMBER --}}
        <div>
            {{-- JIKA ADA VARIAN --}}
            @if (count($product->product_variant) > 1)
            @if(isset($product->promo) && $product->promo->active)
            <div class="flex flex-col">
                <div class="flex">
                    <span class="line-through">
                        <x-client.format-rp :value="$product->product_variant[0]->price" /> &nbsp;-&nbsp;
                        <x-client.format-rp
                            :value="$product->product_variant[count($product->product_variant) - 1]->price" />
                    </span>
                    <span class="text-xs align-top ml-2">-{{ $product->promo->discount }}%</span>
                </div>

                <div>
                    <x-client.format-rp
                        :value="$product->product_variant[0]->price - ($product->product_variant[0]->price * $product->promo->discount / 100)" />
                    &nbsp;-&nbsp;
                    <x-client.format-rp
                        :value="$product->product_variant[count($product->product_variant) - 1]->price - ($product->product_variant[count($product->product_variant) - 1]->price * $product->promo->discount / 100)" />
                </div>
            </div>
            @else
            <div class="flex">
                <x-client.format-rp :value="$product->product_variant[0]->price" /> &nbsp;-&nbsp;
                <x-client.format-rp :value="$product->product_variant[count($product->product_variant) - 1]->price" />
            </div>
            @endif

            {{-- JIKA TIDAK ADA VARIAN --}}
            @else

            {{-- & JIKA ADA PROMO --}}
            @if(isset($product->promo) && $product->promo->active)
            <span class="line-through">
                <span>{{ 'Rp. ' . number_format($product->product_variant->first()->price, 0, ',', '.')
                    }}</span>
            </span>
            <span class="text-xs align-top ml-2">-{{ $product->promo->discount }}%</span>
            <br />
            <span>{{'Rp. ' . number_format($product->product_variant->first()->price -
                ($product->product_variant->first()->price * $product->promo->discount / 100), 0, ',', '.')}}</span>

            {{-- & JIKA TIDAK ADA PROMO --}}
            @else
            <x-client.format-rp :value="$product->product_variant[0]->price" />
            @endif
            @endif
        </div>
        <div class="card-actions">
            <div class="flex">
                <input type="number" name="quantity" x-ref="quantity" class="my-input px-1 w-16" min="1" value="1">
                <div class="tooltip tooltip-bottom" data-tip="Tambah ke keranjang">
                    <button class="btn btn-circle btn-ghost"
                        @click="$store.cart.addToCart('{{ $product->id }}', $refs.variant_id_selected ? $refs.variant_id_selected.value : null, $refs.quantity.value)">
                        <i class="fa fa-opencart"></i>
                    </button>
                </div>
            </div>
        </div>
        @endcan
        @guest
        <div class="tooltip tooltip-bottom before:w-40" data-tip="Login untuk menambahkan ke keranjang">
            <a href="{{ route('login') }}" class="btn btn-circle btn-ghost">
                <i class="fa fa-opencart"></i>
            </a>
        </div>
        @endguest
    </div>
</div>
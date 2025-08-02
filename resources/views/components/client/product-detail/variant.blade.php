<div class="divider">
    Varian
</div>

<div class="variant text-center">
    <select name="variant"
        class="block w-full px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        x-ref="variant_id_selected"
        @change="
            let selectedOption = $refs.variant_id_selected.options[$refs.variant_id_selected.selectedIndex];
            let originalPrice = parseFloat(selectedOption.getAttribute('data-price'));
            let discount = {{ $product->promo->discount ?? 0 }};
            let discountedPrice = originalPrice - (originalPrice * discount / 100);
            let stock = selectedOption.getAttribute('data-stock');

            if ($refs.priceEl) {
                $refs.priceEl.innerHTML = 'Rp. ' + new Intl.NumberFormat('id-ID', { style: 'decimal', minimumFractionDigits: 0 }).format(originalPrice);
            }

            if ($refs.priceAfterDiscountEl) {
                $refs.priceAfterDiscountEl.innerHTML = 'Rp. ' + new Intl.NumberFormat('id-ID', { style: 'decimal', minimumFractionDigits: 0 }).format(discountedPrice);
            }
            if ($refs.subtotal) {
                $refs.subtotal.innerHTML = 'Rp. ' + new Intl.NumberFormat('id-ID', { style: 'decimal', minimumFractionDigits: 0 }).format(discountedPrice * $refs.quantity.value);
            }
            
            if ($refs.stock) {
                $refs.stock.innerHTML = stock;
            }"
        x-init="let selectedOption = $refs.variant_id_selected.options[$refs.variant_id_selected.selectedIndex];
        let originalPrice = parseFloat(selectedOption.getAttribute('data-price'));
        let discount = {{ $product->promo->discount ?? 0 }};
        let discountedPrice = originalPrice - (originalPrice * discount / 100);
        let stock = selectedOption.getAttribute('data-stock');
        
        if ($refs.priceEl) {
            $refs.priceEl.innerHTML = 'Rp. ' + new Intl.NumberFormat('id-ID', { style: 'decimal', minimumFractionDigits: 0 }).format(originalPrice);
        }
        
        if ($refs.priceAfterDiscountEl) {
            $refs.priceAfterDiscountEl.innerHTML = 'Rp. ' + new Intl.NumberFormat('id-ID', { style: 'decimal', minimumFractionDigits: 0 }).format(discountedPrice);
        }
        if ($refs.subtotal) {
            $refs.subtotal.innerHTML = 'Rp. ' + new Intl.NumberFormat('id-ID', { style: 'decimal', minimumFractionDigits: 0 }).format(discountedPrice * $refs.quantity.value);
        }
        
        if ($refs.stock) {
            $refs.stock.innerHTML = stock;
        }">
        @foreach ($product->product_variant as $variant)
            <option class="text-black" value="{{ $variant->id }}" data-price="{{ $variant->price }}"
                data-stock="{{ $variant->stock }}">
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

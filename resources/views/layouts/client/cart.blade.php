<div class="dropdown dropdown-end" x-data>
    {{-- ALERT --}}
    <div x-show="$store.cart.showNotifSuccess" x-transition:leave.duration.500ms
        class="toast toast-top toast-end mt-24 z-50">
        <div role="alert" class="alert alert-success mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-text="$store.cart.message"></span>
        </div>
    </div>
    <div x-show="$store.cart.showNotifFailed" x-transition:leave.duration.500ms
        class="toast toast-top toast-end mt-24 z-50">
        <div role="alert" class="alert alert-error mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-text="$store.cart.message"></span>
        </div>
    </div>
    {{-- END ALERT --}}
    <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
        <div class="indicator">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="text-[10px] indicator-item badge-error p-1 rounded-full" x-show="$store.cart.totalItem"
                x-text="$store.cart.totalItem"></span>
        </div>
    </div>
    <div tabindex="0"
        class="mt-3 z-[1] card card-compact dropdown-content min-w-80 bg-base-100 shadow !border-2 !border-primary">
        <div class="card-body">
            <span class="font-bold text-lg" x-text="$store.cart.totalItem + ' total item'"></span>
            <div class="list-product max-h-80 overflow-auto flex flex-col gap-2">
                <template x-for="item in $store.cart.items">
                    <div class="cart-item mb-3" :key="item.product.id">
                        <div class="flex gap-2">
                            <div class="image">
                                <img :src="item.product.product_pictures.length ?
                                    `/storage/${item.product.product_pictures[0].path}` :
                                    ''"
                                    alt="product-image" width="150" height="150" class="rounded">
                            </div>
                            <div class="name flex-1">
                                <div x-text="item.product.name"></div>
                                <template x-if="item.product_variant">
                                    <template x-for="detail in item.product_variant.product_detail">
                                        <div class="text-xs"
                                            x-text="`${detail.variant_value.variant.variant} ${detail.variant_value.value}`">
                                        </div>
                                    </template>
                                </template>
                                <template x-if="!item.product_variant">
                                    <div>-</div>
                                </template>
                            </div>
                            <div class="price mr-2">
                                <div>
                                    <span x-text="item.quantity"></span>
                                    {{-- JIKA PRODUCT VARIANT ID TIDAK ADA BERARTI TIDAK ADA VARIAN MAKA AMBIL DARI RELASI PRODUCT->PRODUCT_VARAINT, JIKA ADA YA AMBIL DARI PRODUCT_VARIANT GA USAH DARI PRODUCT KARENA BERARTI PRODUCT NYA ADA VARIANT --}}
                                    <template x-if="item.product_variant">
                                        <span
                                            x-text="'x ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(item.product.promo ? item.product_variant.price - (item.product_variant.price * (item.product.promo.discount / 100)) : item.product_variant.price)"></span>
                                    </template>
                                    <template x-if="!item.product_variant">
                                        <span
                                            x-text="item.product.product_variant ? 'x ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(item.product.promo ? item.product.product_variant[0].price - (item.product.product_variant[0].price * (item.product.promo.discount / 100)) : item.product.product_variant[0].price) : ''"></span>
                                    </template>
                                </div>
                                <template x-if="item.product.promo">
                                    <template x-if="item.product_variant">
                                        <div class="line-through ml-auto"
                                            x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(item.product_variant.price)">
                                        </div>
                                    </template>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <span class="font-bold text-lg text-right"
                x-text="'Subtotal: ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format($store.cart.subtotal)"></span>
            <div class="card-actions">
                <a href="{{ route('client.cart') }}" class="btn btn-primary btn-block">Lihat Keranjang</a>
            </div>
        </div>
    </div>
</div>

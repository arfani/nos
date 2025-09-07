<x-client-layout>
    <div class="cart-body p-2" x-data>
        <h1 class="text-3xl lg:text-4xl mb-6 font-bold pl-6">
            <i class="fa fa-cart-shopping"></i> Keranjang Belanjaanmu
        </h1>
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex flex-col gap-2 flex-1">
                <template x-for="item in $store.cart.items">
                    <div class="cart-item bg-base-200 p-4 rounded-t border-b border-primary" :key="item.product.id">
                        <div class="flex flex-col md:flex-row items-center gap-2">
                            <img :src="item.product.product_pictures.length ? `/storage/${item.product.product_pictures[0].path}` :
                                ''"
                                alt="product-image" width="160px" class="rounded mx-2">

                            <div class="name flex-1">
                                <div class="text-xl font-bold" x-text="item.product.name"></div>
                                <template x-if="item.product_variant">
                                    <template x-for="detail in item.product_variant.product_detail">
                                        <div class="text-xs text-center md:text-start"
                                            x-text="`${detail.variant_value.variant.variant} ${detail.variant_value.value}`">
                                        </div>
                                    </template>
                                </template>
                                <template x-if="!item.product_variant">
                                    <div class="text-center md:text-start">-</div>
                                </template>
                            </div>
                            <div class="price flex flex-col text-center">
                                <div>
                                    <span x-text="item.quantity"></span>
                                    {{-- JIKA PRODUCT VARIANT ID TIDAK ADA BERARTI TIDAK ADA VARIAN MAKA AMBIL DARI
                                    RELASI PRODUCT->PRODUCT_VARAINT, JIKA ADA YA AMBIL DARI PRODUCT_VARIANT GA USAH DARI
                                    PRODUCT KARENA BERARTI PRODUCT NYA ADA VARIANT --}}
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
                                        <div class="line-through text-center"
                                            x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(item.product_variant.price)">
                                        </div>
                                    </template>
                                </template>
                                <div class="mt-3" x-data>
                                    <button @click="$store.cart.removeItem(item)"><i class="fa fa-trash"></i></button>
                                    <button class="btn btn-sm btn-ghost"
                                        @click="item.quantity--; $store.cart.updateQty(item, item.quantity)">-</button>
                                    <input type="number" min="1" name="item.quantity" x-model="item.quantity"
                                        class="my-input w-20 !px-1 mx-1"
                                        @change="$store.cart.updateQty(item, item.quantity)">
                                    <button class="btn btn-sm btn-ghost"
                                        @click="item.quantity++; $store.cart.updateQty(item, item.quantity)">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <div x-show="!$store.cart.items.length">Keranjang belanjamu masih kosong !!!</div>
            </div>
            <div class="rounded bg-base-200 p-4 h-fit sticky top-24 bottom-16">
                <h2 class="text-xl font-bold mb-2">Ringkasan Belanja</h2>
                <div class="flex justify-between">
                    <div class="w-32">Total Item</div>
                    <div x-text="$store.cart.totalItem"></div>
                </div>
                <div class="flex justify-between">
                    <div class="w-32" class="">Subtotal</div>
                    <div
                        x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format($store.cart.subtotal)">
                    </div>
                </div>
                <div class="card-actions my-2">
                    <a href="{{ route('client.checkout') }}"
                        :class="`btn btn-primary btn-block ${$store.cart.totalItem == 0 ? 'btn-disabled' : ''}`"><i
                            class="fas fa-handshake"></i> Beli</a>
                </div>
            </div>
        </div>
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
    </div>
</x-client-layout>

<x-modal name="modal-show-order-item">
    <div class="p-4">
        <h1 class="text-2xl mb-4 font-bold text-center">Data Detail Order</h1>

        <div class="mb-2">
            <h2 class="font-bold text-lg">Alamat Pengiriman</h2>
            <span x-text="$store.cart.orderDetail.order_address?.name"></span> •
            <span x-text="$store.cart.orderDetail.order_address?.recipient"></span> •
            <span x-text="$store.cart.orderDetail.order_address?.hp"></span>
            <address x-text="$store.cart.orderDetail.order_address?.address"></address>
            <span x-text="$store.cart.orderDetail.order_address?.area_name"></span>
        </div>

        <div class="mb-2">
            <h2 class="font-bold text-lg">Kurir</h2>
            <div x-show="$store.cart.orderDetail.shipping_method">
                <span x-text="$store.cart.orderDetail.shipping_method?.courier_name"></span> •
                <span x-text="$store.cart.orderDetail.shipping_method?.courier_service_name"></span> •
                Estimasi <span x-text="$store.cart.orderDetail.shipping_method?.duration"></span> •
                <span
                    x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format($store.cart.orderDetail.shipping_method?.price)">
                </span>
            </div>
            <div x-show="!$store.cart.orderDetail.shipping_method">
                <span>Manual</span> •
                <span x-text="$store.cart.orderDetail.shipping_method_manual"></span>
            </div>
        </div>

        <div class="flex justify-between mb-4">
            <div>
                <h2 class="font-bold text-lg">Pembayaran</h2>
                <span x-text="$store.cart.orderDetail.payment_method"></span>
                <span x-text="$store.cart.orderDetail.bank_account?.bank_name"></span>
                <span x-text="$store.cart.orderDetail.bank_account?.account_number"></span>
                <button @click="$store.cart.copyToClipboard($store.cart.orderDetail.bank_account?.account_number)"
                    class="tooltip" data-tip="Copy nomor rekening">
                    <span class="far fa-copy"></span>
                </button>
                <span x-show="$store.cart.showNotifSuccess" x-transition:leave.duration.100ms
                    x-text="$store.cart.message">
                </span>
            </div>

            <div class="text-end">
                <h2 class="font-bold text-lg">Status Pengiriman</h2>
                <span x-text="$store.cart.orderDetail.delivery_state?.name"></span>
            </div>
        </div>

        <div class="flex justify-between mb-4">
            <div>
                <h2 class="font-bold text-lg">Tanggal Order</h2>
                <span
                    x-text="new Date($store.cart.orderDetail.created_at).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                })">
                </span>
            </div>

            <div class="text-end">
                <h2 class="font-bold text-lg">Status Pembayaran</h2>
                <span x-text="$store.cart.orderDetail.is_paid == 0 ? 'Belum Dibayar' : 'Lunas'"></span>
            </div>
        </div>

        <div class="mb-4">
            <h2 class="font-bold text-lg text-center">Data Barang</h2>

            <div class="overflow-auto max-h-40">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>qty</th>
                            <th>Harga</th>
                            <th>Diskon</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(orderDetail, key) in $store.cart.orderDetail.order_detail">
                            <tr class="hover" :key="key">
                                <td x-text="++key"></td>
                                <td>
                                    <template x-if="orderDetail.product_variant">
                                        <span>
                                            <span x-text="orderDetail.product.name"></span>
                                            <br />
                                            <span>
                                                (<template
                                                    x-for="(detail, index) in orderDetail.product_variant.product_detail">
                                                    <span>
                                                        <span x-text="detail.variant_value.variant.variant"></span> -
                                                        <span x-text="detail.variant_value.value"></span>
                                                        <span
                                                            x-text="index < orderDetail.product_variant.product_detail.length - 1 ? ', ' : ''"></span>
                                                    </span>
                                                </template>)
                                            </span>
                                        </span>
                                    </template>
                                    <template x-if="!orderDetail.product_variant">
                                        <span x-text="orderDetail.product.name"></span>
                                    </template>
                                </td>
                                <td x-text="orderDetail.quantity"></td>
                                <td
                                    x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(orderDetail.price)">
                                </td>
                                <td x-text="orderDetail.discount + ' %'"></td>
                                <td
                                    x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(orderDetail.price * orderDetail.quantity)">
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-between mb-4">
            <div>
                <h2 class="font-bold text-lg">Total Bayar</h2>
                <span
                    x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format($store.cart.orderDetail.total)">
                </span>
            </div>

            <div class="text-end self-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="font-normal">
                    {{ __('Tutup') }}
                </x-secondary-button>
            </div>
        </div>

    </div>
</x-modal>

<x-client-layout>
    <div class="cart-body p-2" x-data>
        <h1 class="text-3xl lg:text-4xl mb-6 font-bold pl-6">Atur Pengiriman</h1>
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">

                <div x-show="$store.cart.items.length">
                    <div class="cart-item bg-base-200 p-4 rounded-t border-b border-primary">
                        <div class="text-xl font-bold mb-1">List Barang Belanjanmu</div>
                    </div>
                </div>

                <template x-for="item in $store.cart.items">
                    <div class="cart-item bg-base-200 p-4 rounded-t border-b border-primary" :key="item.product.id">
                        <div class="flex flex-col md:flex-row items-center gap-2">
                            <img :src="item.product.product_pictures.length ? `/storage/${item.product.product_pictures[0].path}` :
                                ''" alt="product-image" width="160px" class="rounded mx-2">

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
                                        <div class="line-through"
                                            x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(item.product_variant.price)">
                                        </div>
                                    </template>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>

                <div x-show="!$store.cart.items.length">
                    <div class="cart-item bg-base-200 p-4 rounded-t border-b border-primary">
                        Keranjang belanjamu masih kosong !! Cek produk kami <a href="{{route('client.products')}}"
                            class="text-bold text-green-500">disini</a>
                    </div>
                </div>
                {{-- END LIST PRODUCT --}}
                
                <div class="flex flex-col gap-2 flex-1 mt-10">
                    <div class="address bg-base-200 p-6 rounded mb-4">
                        <div class="text-xl font-bold mb-1">Alamat Pengiriman</div>
                        {{-- SET ADDRESS DI ALPINE JS --}}
                        <div x-init="$store.cart.setAddress(
                            '{{$address->id}}','{{$address->name}}','{{$address->recipient}}','{{$address->hp}}','{{$address->address}}','{{$address->district}}','{{$address->city}}','{{$address->province}}','{{$address->postal_code}}','{{$address->area_id}}'
                        )">
                        </div>

                        <div class="flex flex-col gap-4">
                            <div class="flex-1 capitalize">
                                <div class="">
                                    <i class="fa fa-map-location-dot mr-2"></i>
                                    <span x-text="$store.cart.addressSelected.name"></span> •
                                    <span x-text="$store.cart.addressSelected.recipient"></span> •
                                    <span x-text="$store.cart.addressSelected.hp"></span>
                                </div>
                                <div class="mt-4">
                                    <span x-text="$store.cart.addressSelected.address"></span>
                                </div>
                                <div class="mt-4">
                                    Kec. <span x-text="$store.cart.addressSelected.district"></span>
                                </div>
                                <div class="">
                                    Kota/Kabupaten <span x-text="$store.cart.addressSelected.city"></span>
                                </div>
                                <div class="">
                                    Prov. <span x-text="$store.cart.addressSelected.province"></span>
                                </div>
                                <div class="">
                                    Kode Pos <span x-text="$store.cart.addressSelected.postal_code"></span>
                                </div>
                            </div>
                            <div class="flex-1 self-start tooltip tooltip-right" data-tip="Ubah alamat">
                                <select name="addresses" id="addresses" class="my-input" @change="$store.cart.setAddress(
                                        $event.target.value,
                                        $event.target.options[$event.target.selectedIndex].dataset.name,
                                        $event.target.options[$event.target.selectedIndex].dataset.recipient,
                                        $event.target.options[$event.target.selectedIndex].dataset.hp,
                                        $event.target.options[$event.target.selectedIndex].dataset.address,
                                        $event.target.options[$event.target.selectedIndex].dataset.district,
                                        $event.target.options[$event.target.selectedIndex].dataset.city,
                                        $event.target.options[$event.target.selectedIndex].dataset.province,
                                        $event.target.options[$event.target.selectedIndex].dataset.postal_code,
                                        $event.target.options[$event.target.selectedIndex].dataset.area_id,
                                    )">
                                    @foreach ($addresses as $address)
                                    <option value="{{$address->id}}" data-name="{{$address->name}}"
                                        data-recipient="{{$address->recipient}}" data-hp="{{$address->hp}}"
                                        data-address="{{$address->address}}" data-district="{{$address->district}}"
                                        data-city="{{$address->city}}" data-province="{{$address->province}}"
                                        data-postal_code="{{$address->postal_code}}"
                                        data-area_id="{{$address->area_id}}">
                                        {{$address->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- METODE PENGIRIMAN --}}
                    <div class="courier bg-base-200 p-6 rounded mb-4 flex items-center gap-4 flex-col lg:flex-row">
                        <button class="btn btn-primary lg:self-start"
                            @click.prevent="$dispatch('open-modal', 'courier-list'); $store.cart.setCourierList();">
                            <i class="fa fa-truck"></i> Pengiriman
                        </button>
                        <div x-show="Object.keys($store.cart.courierSelected).length == 0" class="text-base-content">
                            Anda belum memilih metode pengiriman !
                        </div>
                        <div x-show="Object.keys($store.cart.courierSelected).length > 0"
                            class="capitalize font-bold flex flex-col sm:flex-row w-full items-center justify-evenly gap-2">
                            <div class="flex flex-col items-center">
                                <div
                                    x-text="`${$store.cart.courierSelected.courier_name} - ${$store.cart.courierSelected.courier_service_name}`">
                                </div>
                                <div
                                    x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format($store.cart.courierSelected.price)">
                                </div>
                            </div>

                            <div class="flex flex-col items-center">
                                <div>Estimasi</div>
                                <div x-text="$store.cart.courierSelected.duration">
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('client.cart.modal-courier-list')
                    {{-- END METODE PENGIRIMAN --}}

                    {{-- METODE PEMBAYARAN --}}
                    <div class="courier bg-base-200 p-6 rounded mb-4 flex flex-col lg:flex-row items-center gap-4 ">
                        <button class="btn btn-primary lg:self-start" @click.prevent="$refs.transferBtn.focus()">
                            <i class="fa fa-money-bill-wave"></i> Pembayaran
                        </button>
                        <div x-show="!$store.cart.paymentMethod" class="text-base-content text-center">
                            Pilih metode pembayaran !
                        </div>
                        <div class="flex gap-4 justify-center md:justify-end flex-1 flex-col sm:flex-row">
                            <button x-ref="transferBtn"
                                :class="`btn ${$store.cart.paymentMethod=='Transfer' ? 'btn-primary' : ''}`"
                                @click.prevent="$store.cart.setPaymentMethod('Transfer')"><i
                                    class="fa fa-credit-card"></i> Transfer <i
                                    x-show="$store.cart.paymentMethod=='Transfer'"
                                    class="fa fa-circle-check text-[#086B35]"></i></button>
                            <button :class="`btn ${$store.cart.paymentMethod=='Cash' ? 'btn-primary' : ''}`"
                                @click.prevent="$store.cart.setPaymentMethod('Cash')"><i class="fa fa-money-bills"></i>
                                Cash <i x-show="$store.cart.paymentMethod=='Cash'"
                                    class="fa fa-circle-check text-[#086B35]"></i></button>
                        </div>
                    </div>
                    {{-- END METODE PEMBAYARAN --}}
                </div>

            </div>

            {{-- RINGKASAN BELANJA --}}
            <div class="rounded bg-base-200 p-4 h-fit sticky top-24 bottom-16">
                <h2 class="text-xl font-bold mb-2">Ringkasan Belanja</h2>
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between">
                        <div class="w-32">Total Item</div>
                        <div x-text="$store.cart.totalItem"></div>
                    </div>
                    <div class="flex justify-between">
                        <div class="w-32">Total Berat</div>
                        <div x-text="$store.cart.totalWeight + ' g'"></div>
                    </div>
                    <div class="flex justify-between">
                        <div class="w-32">Subtotal</div>
                        <div
                            x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format($store.cart.subtotal)">
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="w-32">Ongkir</div>
                        <div
                            x-text="JSON.stringify($store.cart.courierSelected) !== '{}' ? new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format($store.cart.courierSelected.price) : '-'">
                        </div>
                    </div>
                    <div class="divider my-0"></div>
                    <div class="flex justify-between">
                        <div class="w-32">Total bayar</div>
                        <div
                            x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format($store.cart.subtotal + ($store.cart.courierSelected.price || 0))">
                        </div>
                    </div>
                </div>
                <div class="card-actions mb-2 mt-4">
                    <a href="#"
                        :class="`btn btn-primary btn-block font-bold tracking-widest ${(!$store.cart.paymentMethod || Object.keys($store.cart.courierSelected).length == 0)  || $store.cart.isLoading || $store.cart.totalItem == 0 ? 'btn-disabled' : ''}`"
                        @click.prevent="$store.cart.submitOrder()">
                        <span x-show="!$store.cart.isLoading">
                            <i class="fa fa-paper-plane"></i>
                            ORDER
                        </span>
                        <span x-show="$store.cart.isLoading">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-client-layout>
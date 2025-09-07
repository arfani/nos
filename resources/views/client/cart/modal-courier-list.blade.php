<x-modal name="courier-list">
    <div class="p-4">
        <h1 class="text-xl mb-4 font-bold">Pilih Metode Pengiriman</h1>

        <label class="text-lg font-bold mb-2" for="manual">Manual</label>
        <div class="flex flex-col gap-2">
            <input type="text" id="manual" class="my-input flex-1" x-ref="shippingManual"
                placeholder="Contoh: COD / Ambil di toko / Mex Udara / Kereta Api Logistik / Cargo Lainnya">
            <button class="btn btn-primary"
                @click.prevent="$store.cart.setCourierSelected($refs.shippingManual.value); $dispatch('close');">Pilih
                Manual</button>
        </div>

        <h2 class="text-lg font-bold mb-2 mt-10">Lainnya</h2>
        <template x-for="courierRate in $store.cart.courierList">
            <div :key="courierRate"
                @click.prevent="$store.cart.setCourierSelected(courierRate); $dispatch('close');"
                class="bg-base-200 text-base-content mb-4 p-4 rounded flex flex-col justify-between cursor-pointer gap-2">

                <div class="flex justify-between flex-wrap">
                    <div class="capitalize"
                        x-text="`${courierRate.courier_name} - ${courierRate.courier_service_name}`">
                    </div>
                    <div class="font-bold text-xl"
                        x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(courierRate.price)">
                    </div>
                </div>
                <div class="flex justify-between flex-wrap">
                    <div class="capitalize" x-text="courierRate.description"></div>
                    <div class="capitalize" x-text="`Estimasi : ${courierRate.duration}`"></div>
                </div>
                <div class="flex justify-between flex-wrap">
                    <div class="capitalize" x-text="`${courierRate.service_type} - ${courierRate.shipping_type}`"></div>
                    {{-- <div class="capitalize" x-show="courierRate.available_for_cash_on_delivery">
                        COD <i class="fas fa-circle-check text-green-500"></i>
                    </div> --}}
                </div>
                {{-- <div class="flex justify-between flex-wrap">
                    <div class="capitalize" x-show="courierRate.available_for_insurance">
                        Asuransi <i class="fas fa-circle-check text-green-500"></i>
                    </div>
                    <div class="capitalize" x-show="courierRate.available_for_proof_of_delivery">
                        COD cek dulu <i class="fas fa-circle-check text-green-500"></i>
                    </div>
                </div> --}}

            </div>
        </template>
    </div>
</x-modal>
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

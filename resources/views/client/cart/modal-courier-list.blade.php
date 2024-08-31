<x-modal name="courier-list">
    <div class="p-4">
        <h1 class="text-xl mb-4 font-bold">Pilih Metode Pengiriman</h1>
        <template x-for="courierRate in $store.cart.courierList">
            <div :key="courierRate" @click.prevent="$store.cart.setCourierSelected(courierRate); $dispatch('close');"
                class="bg-base-200 text-base-content mb-4 p-4 rounded flex flex-col justify-between cursor-pointer gap-2">

                <div class="flex justify-between flex-wrap">
                    <div class="capitalize"
                        x-text="`${courierRate.courier_name} - ${courierRate.courier_service_name}`"></div>
                    <div
                    class="font-bold text-xl"
                        x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(courierRate.price)">
                    </div>
                </div>
                <div class="flex justify-between flex-wrap">
                    <div class="capitalize" x-text="courierRate.description"></div>
                    <div class="capitalize" x-text="`Estimasi : ${courierRate.duration}`"></div>
                </div>
                <div class="flex justify-between flex-wrap">
                    <div class="capitalize" x-text="`${courierRate.service_type} - ${courierRate.shipping_type}`"></div>
                    <div class="capitalize" x-show="courierRate.available_for_cash_on_delivery">
                        COD <i class="fas fa-circle-check text-green-500"></i>
                    </div>
                </div>
                <div class="flex justify-between flex-wrap">
                    <div class="capitalize" x-show="courierRate.available_for_insurance">
                        Asuransi <i class="fas fa-circle-check text-green-500"></i>
                    </div>
                    <div class="capitalize" x-show="courierRate.available_for_proof_of_delivery">
                        COD cek dulu <i class="fas fa-circle-check text-green-500"></i>
                    </div>
                </div>

            </div>
        </template>
    </div>
</x-modal>
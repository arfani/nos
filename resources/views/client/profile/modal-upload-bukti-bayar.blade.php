<x-modal name="modal-upload-bukti-bayar">
    <div class="p-4">
        <h1 class="text-2xl mb-4 font-bold text-center">Bukti Pembayaran</h1>

        <form :action="`/order/${$store.cart.orderDetail.id}`" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="flex flex-col mb-4">
                <label for="bukti_bayar" class="font-semibold mb-2">Upload bukti bayar</label>
                <input type="file" name="bukti_bayar" id="bukti_bayar" required>
            </div>

            <template x-if="$store.cart.orderDetail.bukti_pembayaran">
                <div class="mt-1">
                    <p class="text-warning text-xs">Pilih file baru jika ingin mengubah bukti bayar saat ini</p>
                    <div class="mt-4 mb-1">Bukti bayar saat ini</div>
                    <img :src="`/storage/${$store.cart.orderDetail.bukti_pembayaran}`" alt="current bukti pembayaran" width="150">
                </div>
            </template>

            <div class="tooltip mt-4" data-tip="Simpan">
                <x-primary-button class="">
                    Submit <i class="fa fa-paper-plane"></i>
                </x-primary-button>
            </div>
        </form>

    </div>
</x-modal>
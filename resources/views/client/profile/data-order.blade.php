<div class="sm:mx-6 lg:mx-8 p-6 py-10 bg-base-300 text-base-content rounded overflow-x-auto">
    @if (Session::get('success'))
    <div x-data="{ show: true }" x-show="show" x-transition:leave.duration.500ms
        x-init="setTimeout(() => show = false, 5000)" class="toast toast-top toast-end mt-10 z-10">
        <div role="alert" class="alert alert-success mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ Session::get('success') }}</span>
        </div>
    </div>
    @endif

    {{-- TAMPILKAN NOTIF SETELAH ORDER BERHASIL --}}
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

    <div class="flex">
        <span class="mb-3">
            <form class="flex [&_option]:bg-secondary" id="form_search">
                <div class="tooltip" data-tip="Data per halaman">
                    <select id="numb_per_page" name="numb_per_page" class="my-input mr-2">
                        <option value="5" @if ($numb_per_page=='5' ) selected @endif>5
                        </option>
                        <option value="10" @if ($numb_per_page=='10' ) selected @endif>10
                        </option>
                        <option value="25" @if ($numb_per_page=='25' ) selected @endif>25
                        </option>
                        <option value="50" @if ($numb_per_page=='50' ) selected @endif>50
                        </option>
                        <option value="100" @if ($numb_per_page=='100' ) selected @endif>100
                        </option>
                    </select>
                </div>
                {{-- <div class="inline-block my-input whitespace-nowrap">
                    <input type="text" id="search" name="name"
                        class="border-transparent focus:outline-none focus:ring-0 focus:border-transparent bg-transparent"
                        placeholder="Cari berdasarkan nama" @isset($validated['name'])value="{{ $validated['name'] }}"
                        @endisset>
                    <button type="submit"
                        class="bg-primary/70 hover:bg-primary border border-primary py-1 px-2 rounded-full cursor-pointer hover:scale-105 text-primary-content">
                        <i class="fas fa-search"></i>
                    </button>
                </div> --}}
            </form>
        </span>
    </div>

    <table class="table">
        <thead>
            {{-- <tr
                class="text-left border-b leading-9 bg-primary text-primary-content border-b-yellow-100 [&>th]:p-2">
                --}}
            <tr>
                <th>No</th>
                <th>Alamat Pengiriman</th>
                <th>Pembayaran</th>
                <th>Tanggal Order</th>
                <th>Total Bayar</th>
                <th>Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            {{-- <tr
                class="border-b odd:bg-white/5 odd:text-accent-content [&>td]:p-2 hover:bg-primary hover:text-primary-content">
                --}}
            <tr class="hover">
                <td>{{ ++$indexNumber }}</td>

                <td>{{$item->order_address->name}}</td>
                <td>{{$item->payment_method}}</td>
                <td>{{$item->created_at->isoFormat('LL')}}</td>
                <td>
                    <x-client.format-rp value="{{$item->total}}" />
                </td>
                <td>{{$item->delivery_state->name}}</td>
                <td>
                    <div class="flex gap-4 justify-center">
                        @if ($item->payment_method == 'Transfer')
                        <div class="tooltip" data-tip="Upload Bukti Bayar">
                            <a href="#"
                                @click.prevent="$dispatch('open-modal', 'modal-upload-bukti-bayar'); $store.cart.getOrderDetail('{{$item->id}}')">
                                <i class="fa fa-money-bills text-red-600"></i>
                            </a>
                        </div>
                        @endif
                        <div class="tooltip" data-tip="Download Invoice">
                            <form action="{{ route('download-invoice', $item->id) }}" method="post" target="_blank"
                                class="inline-block">
                                @csrf
                                <button type="submit">
                                    <i class="fa fa-download text-blue-600"></i>
                                </button>
                            </form>
                        </div>
                        <div class="tooltip" data-tip="Lihat">
                            <a href="#"
                                @click.prevent="$dispatch('open-modal', 'modal-show-order-item'); $store.cart.getOrderDetail('{{$item->id}}')">
                                <i class="fa fa-eye text-teal-600"></i>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="[&_p]:!text-secondary-content [&_.bg-white]:bg-primary [&_.bg-white]:text-primary-content mt-10">
        {!! $data->links() !!}
    </div>

    @include('client.profile.modal-show-order-item')
    @include('client.profile.modal-upload-bukti-bayar')
</div>
@push('scripts')
<script>
    (function() {
            const deleteBtn = document.querySelectorAll('button.delete')

            deleteBtn.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    const isDeleteConfirmed = confirm('Apakah Anda yakin ingin menghapus item ini ?')
                    // jika konfirmasi ditolak maka batalkan submit
                    if (!isDeleteConfirmed) {
                        e.preventDefault()
                    }
                })
            })

            // SUBMIT SEARCH AFTER NUMBER OF ROWS FILTER CHANGED
            const numbRows = document.getElementById('numb_per_page')
            const submitForm = document.getElementById('form_search')

            numbRows.addEventListener('change', function(e) {
                submitForm.submit()
            })
        })()
</script>
@endpush
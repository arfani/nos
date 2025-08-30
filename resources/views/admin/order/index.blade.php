<x-app-layout>
    <div class="sm:mx-6 lg:mx-8 p-6 py-10 rounded overflow-x-auto">
        @if (Session::get('success'))
            <div x-data="{ show: true }" x-show="show" x-transition:leave.duration.500ms x-init="setTimeout(() => show = false, 5000)"
                class="toast toast-top toast-end mt-10 z-10">
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

        <div class="flex">
            <span class="ml-auto mb-3">
                <form class="flex [&_option]:bg-secondary" id="form_search">
                    <div class="tooltip" data-tip="Data per halaman">
                        <select id="numb_per_page" name="numb_per_page" class="my-input mr-2 text-accent-content">
                            <option value="5" @if ($numb_per_page == '5') selected @endif>5
                            </option>
                            <option value="10" @if ($numb_per_page == '10') selected @endif>10
                            </option>
                            <option value="25" @if ($numb_per_page == '25') selected @endif>25
                            </option>
                            <option value="50" @if ($numb_per_page == '50') selected @endif>50
                            </option>
                            <option value="100" @if ($numb_per_page == '100') selected @endif>100
                            </option>
                        </select>
                    </div>
                    <div class="inline-block my-input whitespace-nowrap">
                        <input type="text" id="search" name="invoice"
                            class="border-transparent focus:outline-none focus:ring-0 focus:border-transparent bg-transparent"
                            placeholder="Cari berdasarkan invoice"
                            @isset($validated['invoice'])value="{{ $validated['invoice'] }}" @endisset>
                        <button type="submit"
                            class="bg-primary/70 hover:bg-primary border border-primary py-1 px-2 rounded-full cursor-pointer hover:scale-105 text-primary-content">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="table bg-base-200">
                <thead>
                <tr class="bg-base-300">
                        <th class="text-center">No</th>
                        <th class="text-center">Member</th>
                        <th class="text-center">Invoice</th>
                        <th class="text-center text-nowrap">Dikirim Ke</th>
                        <th class="text-center">Kurir</th>
                        <th class="text-center">Pembayaran</th>
                        <th class="text-center">Total Bayar</th>
                        <th class="text-center">Sudah Dibayar</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Tanggal Order</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $order)
                    <tr class="odd:bg-primary/5">
                            <td class="text-center">{{ ++$indexNumber }}</td>
                            <td class="text-center">{{ $order->user->name }}</td>
                            <td class="text-center">{{ $order->invoice }}</td>
                            <td class="text-center">{{ $order->order_address->name }}</td>
                            <td class="text-center">
                                {{ $order->shipping_method->courier_name . ' - ' . $order->shipping_method->courier_service_name }}
                            </td>
                            <td class="text-center">{{ $order->payment_method }}</td>
                            <td class="text-center">
                                <x-client.format-rp value="{{ $order->total }}" />
                            </td>
                            <td class="text-center">{{ $order->is_paid ? 'Lunas' : 'Belum Lunas' }}</td>
                            <td class="text-center">{{ $order->delivery_state->name }}</td>
                            <td class="text-center">{{ $order->created_at->isoFormat('LL') }}</td>
                            <td class="text-center">
                                <div class="flex gap-3 justify-center">
                                    <div class="tooltip" data-tip="Lihat">
                                        <a href="{{ route('admin-order.show', $order->id) }}">
                                            <i class="fa fa-eye text-teal-600"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div
                class="[&_p]:!text-secondary-content [&_.bg-white]:bg-primary [&_.bg-white]:text-primary-content mt-10">
                {!! $data->links() !!}
            </div>
        </div>
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
</x-app-layout>

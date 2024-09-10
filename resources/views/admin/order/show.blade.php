<x-app-layout>
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
    <div class="sm:mx-6 lg:mx-8 p-6 py-10 bg-secondary text-secondary-content rounded overflow-x-auto">
        <div class="flex flex-col sm:flex-row items-center sm:items-start p-4 gap-8 sm:gap-2">
            {{-- LEFT SIDE --}}
            <div class="card w-80 bg-base-200 shadow-xl">
                <figure class="px-10 pt-10 pb-2 flex flex-col gap-4">
                    <h2 class="font-bold">DATA MEMBER</h2>
                    <div class="avatar">
                        <div class="w-full rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img src="{{ isset($data->user->img) ? Storage::url($data->user->img) : asset('assets/images/image-not-found.webp') }}"
                                alt="profile picture" />
                        </div>
                    </div>
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">{{ $data->user->fullname }}</h2>
                    <p>{{ $data->user->email }}</p>
                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="flex-1 bg-base-200 shadow-xl card">
                <div x-data="{ activeTab: 1 }">
                    <div class="flex bg-base-300 rounded-t-2xl">
                        <button class="uppercase px-8 py-3 -mb-px text-sm rounded-t-2xl font-bold"
                            :class="activeTab === 1 ? 'border-base-200 bg-base-200' : 'text-gray-600'"
                            @click="activeTab = 1">
                            DATA ORDER
                        </button>
                    </div>

                    <!-- Tab Contents -->
                    <div class="p-6 bg-base-200 rounded text-sm">
                        <div x-show="activeTab === 1">
                            <h2 class="font-bold uppercase mb-2">No Invoice : <b class="text-base-content">{{
                                    $data->invoice }}</b></h2>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Dikirim Ke :</span><span>{{ $data->order_address->name
                                    }}</span>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Kurir :</span><span>{{ $data->shipping_method->courier_name .
                                    ' - ' . $data->shipping_method->courier_service_name }}</span>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Jenis Pembayaran :</span><span>{{ $data->payment_method
                                    }}</span>
                                @if($data->payment_method === 'Transfer' && $data->delivery_state_id > 1)
                                <span class="tooltip" data-tip="Lihat bukti bayar">
                                    <a href="{{Storage::url($data->bukti_pembayaran)}}" target="_blank"><i
                                            class="fa fa-download text-blue-500"></i></a>
                                </span>
                                @endif
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Total Bayar :</span><span>
                                    <x-client.format-rp value="{{$data->total}}" />
                                </span>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Sudah Dibayar :</span><span>{{ $data->is_paid ? 'Lunas' :
                                    'Belum Lunas' }}</span>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Status :</span><span>{{ $data->delivery_state->name }}</span>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Tanggal Order :</span><span>{{
                                    $data->created_at->isoFormat('LL') }}</span>
                            </div>

                            {{-- DATA BARANG --}}
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
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->order_detail as $key => $order_detail)
                                            <tr class="hover">
                                                <td>{{++$key}}</td>
                                                <td>
                                                    @if ($order_detail->product_variant)
                                                    <span>
                                                        <span>{{$order_detail->product->name}}</span>
                                                        <br />
                                                        <span>
                                                            (
                                                            @foreach ($order_detail as $index => $detail)
                                                            <span>
                                                                <span>
                                                                    {{$detail->variant_value->variant->variant}}
                                                                </span> -
                                                                <span>
                                                                    {{$detail->variant_value->value}}
                                                                </span>
                                                                <span>
                                                                    {{$index < count(order_detail->
                                                                        product_variant->product_detail) - 1
                                                                        ? ', ' : ''}}
                                                                </span>
                                                            </span>
                                                            @endforeach
                                                            )
                                                        </span>
                                                    </span>
                                                    @else
                                                    <span>{{$order_detail->product->name}}</span>
                                                    @endif
                                                </td>
                                                <td>{{$order_detail->quantity}}</td>
                                                <td>
                                                    <x-client.format-rp value="{{$order_detail->price}}" />
                                                </td>
                                                <td>
                                                    <x-client.format-rp
                                                        value="{{$order_detail->price * $order_detail->quantity}}" />
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- END DATA BARANG --}}

                            <div class="flex gap-2 mt-6">
                                <a href="{{ route('admin-order.index') }}" class="btn btn-secondary btn-sm">
                                    {{ __('Kembali') }}
                                </a>

                                @if ($data->delivery_state_id < 5) 
                                <form
                                    action="{{ route('admin-order.next-state', $data->id) }}" method="post"
                                    class="inline-block">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Next Status <i class="fa fa-arrow-right"></i>
                                    </button>
                                    </form>
                                    @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
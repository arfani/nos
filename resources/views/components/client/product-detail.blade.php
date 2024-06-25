@props(['product'])

<div class="flex flex-wrap gap-2 mb-4">
    @if ($product['lelang']['active'])
        <x-client.product-detail.lelang :product="$product" />
    @else
        @if ($product['promo']['active'])
            <x-client.product-detail.promo :product="$product" />
        @else
            <x-client.product-detail.normal :product="$product" />
        @endif
    @endif
</div>

@if ($product['lelang']['active'])
<div id="bidding" class="mb-14 mt-0"></div>
    <div class="w-full sm:w-11/12 mb-6 mx-auto" x-data="{ activeTab: 1 }">
        <div class="flex justify-center">
            <button class="px-4 py-2 -mb-px text-sm font-medium border-b-2"
                :class="activeTab === 1 ? 'border-primary' : 'border-gray-800 text-gray-600'" @click="activeTab = 1">
                Bidding
            </button>
            <button class="px-4 py-2 -mb-px text-sm font-medium border-b-2"
                :class="activeTab === 2 ? 'border-primary' : 'border-gray-800 text-gray-600'" @click="activeTab = 2">
                Komentar
            </button>
        </div>

        <!-- Tab Contents -->
        <div class="p-6 bg-base-200 rounded">
            <div x-show="activeTab === 1">
                <h2 class="text-lg font-semibold pb-1 px-3 rounded border-b-2 border-b-primary w-fit mx-auto">Bidding
                </h2>
                <div class="flex gap-1 justify-center my-4">
                    <input type="number" value="105000" step="5000" min="105000" class="input">
                    <div class="tooltip" data-tip="Bid">
                        <button class="btn btn-primary"><fa class="fa fa-bullseye"></fa></button>
                    </div>
                </div>

                <div class="chat chat-start">
                    <div class="chat-image avatar">
                        <div class="w-10 rounded-full">
                            <img alt="Tailwind CSS chat bubble component"
                                src="{{ Storage::url('mocks/me.jpg') }}" />
                        </div>
                    </div>
                    <div class="chat-header">
                        Obi-Wan Kenobi
                    </div>
                    <div class="chat-bubble"><x-client.format-rp value="205000" /></div>
                    <div class="chat-footer opacity-50">
                        {{ now()->isoFormat('LLLL') }}
                    </div>
                </div>


                <div class="chat chat-end">
                    <div class="chat-image avatar">
                        <div class="w-10 rounded-full">
                            <img alt="Tailwind CSS chat bubble component"
                                src="{{ Storage::url('mocks/me.jpg') }}" />
                        </div>
                    </div>
                    <div class="chat-header">
                        Anda
                    </div>
                    <div class="chat-bubble"><x-client.format-rp value="190000" /></div>
                    <div class="chat-footer opacity-50">
                        {{ now()->isoFormat('LLLL') }}
                    </div>
                </div>
                
                <div class="chat chat-start">
                    <div class="chat-image avatar">
                        <div class="w-10 rounded-full">
                            <img alt="Tailwind CSS chat bubble component"
                                src="{{ Storage::url('mocks/me.jpg') }}" />
                        </div>
                    </div>
                    <div class="chat-header">
                        Andi
                    </div>
                    <div class="chat-bubble"><x-client.format-rp value="170000" /></div>
                    <div class="chat-footer opacity-50">
                        {{ now()->isoFormat('LLLL') }}
                    </div>
                </div>
                
                <div class="chat chat-start">
                    <div class="chat-image avatar">
                        <div class="w-10 rounded-full">
                            <img alt="Tailwind CSS chat bubble component"
                                src="{{ Storage::url('mocks/me.jpg') }}" />
                        </div>
                    </div>
                    <div class="chat-header">
                        Dayat
                    </div>
                    <div class="chat-bubble"><x-client.format-rp value="150000" /></div>
                    <div class="chat-footer opacity-50">
                        {{ now()->isoFormat('LLLL') }}
                    </div>
                </div>
            </div>
            <div x-show="activeTab === 2">
                <h2 class="text-lg font-semibold pb-1 px-3 rounded border-b-2 border-b-primary w-fit mx-auto">Komentar
                </h2>
                <div class="flex gap-1 justify-center my-4">
                    <input type="text" class="input" placeholder="komentar yang sopan">
                    <div class="tooltip" data-tip="Komentar">
                        <button class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
                    </div>
                </div>

                <div class="chat chat-start">
                    <div class="chat-image avatar">
                        <div class="w-10 rounded-full">
                            <img alt="Tailwind CSS chat bubble component"
                                src="{{ Storage::url('mocks/me.jpg') }}" />
                        </div>
                    </div>
                    <div class="chat-header">
                        Obi-Wan Kenobi
                    </div>
                    <div class="chat-bubble">Komentar nya disini</div>
                    <div class="chat-footer opacity-50">
                        {{ now()->isoFormat('LLLL') }}
                    </div>
                </div>


                <div class="chat chat-end">
                    <div class="chat-image avatar">
                        <div class="w-10 rounded-full">
                            <img alt="Tailwind CSS chat bubble component"
                                src="{{ Storage::url('mocks/me.jpg') }}" />
                        </div>
                    </div>
                    <div class="chat-header">
                        Anda
                    </div>
                    <div class="chat-bubble">Komentar nya disini</div>
                    <div class="chat-footer opacity-50">
                        {{ now()->isoFormat('LLLL') }}
                    </div>
                </div>
                
                <div class="chat chat-start">
                    <div class="chat-image avatar">
                        <div class="w-10 rounded-full">
                            <img alt="Tailwind CSS chat bubble component"
                                src="{{ Storage::url('mocks/me.jpg') }}" />
                        </div>
                    </div>
                    <div class="chat-header">
                        Andi
                    </div>
                    <div class="chat-bubble">Komentar nya disini</div>
                    <div class="chat-footer opacity-50">
                        {{ now()->isoFormat('LLLL') }}
                    </div>
                </div>
                
                <div class="chat chat-start">
                    <div class="chat-image avatar">
                        <div class="w-10 rounded-full">
                            <img alt="Tailwind CSS chat bubble component"
                                src="{{ Storage::url('mocks/me.jpg') }}" />
                        </div>
                    </div>
                    <div class="chat-header">
                        Dayat
                    </div>
                    <div class="chat-bubble">Komentar nya disini</div>
                    <div class="chat-footer opacity-50">
                        {{ now()->isoFormat('LLLL') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

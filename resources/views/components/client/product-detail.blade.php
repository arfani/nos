@props(['product'])

<div class="flex flex-wrap gap-2 mb-4" x-data>
    @if (isset($product->auction) && $product->auction->active)
        <x-client.product-detail.lelang :product="$product" />
    @elseif (isset($product->promo) && $product->promo->active)
        <x-client.product-detail.promo :product="$product" />
    @else
        <x-client.product-detail.normal :product="$product" />
    @endif
</div>

@if (isset($product->auction) && $product->auction->active)

    @if (Session::get('success'))
        <div x-data="{ show: true }" x-show="show" x-transition:leave.duration.500ms x-init="setTimeout(() => show = false, 5000)"
            class="toast toast-top toast-end mt-20 z-50">
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

    <div id="bidding" class="mb-14 mt-0"></div>
    <div class="w-full sm:w-11/12 mb-6 mx-auto" x-data>
        <div class="flex justify-center">
            <button class="px-4 py-2 -mb-px text-sm font-medium border-b-2"
                :class="!$store.auction.isCommentTab ? 'border-primary' : 'border-gray-800 text-gray-600'"
                @click="$store.auction.isCommentTab = false">
                Bidding
            </button>
            <button class="px-4 py-2 -mb-px text-sm font-medium border-b-2"
                :class="$store.auction.isCommentTab ? 'border-primary' : 'border-gray-800 text-gray-600'"
                @click="$store.auction.isCommentTab = true">
                Komentar
            </button>
        </div>

        <!-- Tab Contents -->
        <div class="p-6 bg-base-200 rounded">
            <div x-show="!$store.auction.isCommentTab">
                @guest
                    <div class="text-center text-error animate-pulse">Silahkan login untuk melakukan bidding</div>
                @endguest
                <h2 class="text-lg font-semibold pb-1 px-3 rounded border-b-2 border-b-primary w-fit mx-auto">
                    Bidding
                </h2>
                @can('is-admin')
                <div class="flex gap-1 justify-center my-4">
                    Hanya member yang bisa bidding
                </div>
                @endcan
                @can('is-member')
                    <div class="flex gap-1 justify-center my-4">
                        <form action="{{ route('bid.store') }}" method="POST">
                            @csrf
                            <input type="number" name="value"
                                value="{{ $product->auction->bids->isNotEmpty() ? $product->auction->bids->first()->value + $product->auction->bid_increment : $product->auction->bid_start }}"
                                step="{{ $product->auction->bid_increment }}" min="{{ $product->auction->bid_start }}"
                                class="input">
                            <input type="hidden" name="auction_id" value="{{ $product->auction->id }}">
                            <div class="tooltip" data-tip="Bid">
                                <button class="btn btn-primary" type="submit">
                                    <fa class="fa fa-bullseye"></fa>
                                </button>
                            </div>
                        </form>
                    </div>
                @endcan

                @foreach ($product->auction->bids as $bid)
                    <div
                        class="chat {{ auth()->user() && $bid->user->id === auth()->user()->id ? 'chat-end' : 'chat-start' }}">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                                <img alt="{{ 'Foto ' . $bid->user->name }}" src="{{ Storage::url($bid->user->img) }}" />
                            </div>
                        </div>
                        <div class="chat-header">
                            {{ auth()->user() && $bid->user->id === auth()->user()->id ? 'Anda' : $bid->user->name }}
                        </div>
                        <div class="chat-bubble"><x-client.format-rp value="{{ $bid->value }}" /></div>
                        <div class="chat-footer opacity-50">
                            {{ $bid->created_at->isoFormat('LLLL') }}
                        </div>
                    </div>
                @endforeach

            </div>
            <div x-show="$store.auction.isCommentTab">
                @guest
                    <div class="text-center text-error animate-pulse">Silahkan login untuk berkomentar</div>
                @endguest
                <h2 class="text-lg font-semibold pb-1 px-3 rounded border-b-2 border-b-primary w-fit mx-auto">
                    Komentar
                </h2>
                @auth
                    <div class="flex gap-1 justify-center my-4">
                        <form action="{{ route('comment.store') }}" method="POST">
                            @csrf
                            <input type="text" name="comment" class="input" placeholder="komentar yang sopan">
                            <input type="hidden" name="auction_id" value="{{ $product->auction->id }}">
                            <div class="tooltip" data-tip="Komentar">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                @endauth

                @foreach ($product->auction->comments as $comment)
                    <div
                        class="chat {{ auth()->user() && $comment->user->id === auth()->user()->id ? 'chat-end' : 'chat-start' }}">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                                <img alt="{{ 'Foto ' . $comment->user->name }}"
                                    src="{{ Storage::url($comment->user->img) }}" />
                            </div>
                        </div>
                        <div class="chat-header">
                            {{ auth()->user() && $comment->user->id === auth()->user()->id ? 'Anda' : $comment->user->name }}
                        </div>
                        <div class="chat-bubble">{{ $comment->comment }}</div>
                        <div class="chat-footer opacity-50">
                            {{ $comment->created_at->isoFormat('LLLL') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif


<x-modal name="share-product" focusable>

    <div class="p-6 pb-12">
        <div class="text-center mb-4">
            <h1 class="font-bold text-xl">Bagikan</h1>
        </div>
        <div class="flex justify-center gap-4">
            <div class="tooltip tooltip-bottom" data-tip="Facebook">
                <a href="https://www.facebook.com/sharer.php?u={{ url()->current() }}" target="_blank">
                    <i class="fa fa-facebook text-3xl"></i>
                </a>
            </div>
            <div x-data="deviceDetection()" class="tooltip tooltip-bottom" data-tip="Whatsapp">
                <a :href="whatsappUrl" target="_blank">
                    <i class="fa fa-whatsapp text-3xl"></i>
                </a>
            </div>
            <div class="tooltip tooltip-bottom" data-tip="Twitter">
                <a href="https://twitter.com/share?url={{ url()->current() }}&text={{ $product->name }}"
                    target="_blank">
                    <i class="fa fa-twitter text-3xl"></i>
                </a>
            </div>
            <div class="tooltip tooltip-bottom" data-tip="Copy to clipboard">
                <a href="#" x-data @click.prevent="navigator.clipboard.writeText('{{ url()->current() }}')">
                    <i class="fa fa-copy text-3xl"></i>
                </a>
            </div>
        </div>
    </div>

    <script>
        function deviceDetection() {
            return {
                isMobile: window.matchMedia("(max-width: 767px)").matches,
                get whatsappUrl() {
                    const currentUrl = '{{ url()->current() }}';
                    return this.isMobile ?
                        `https://api.whatsapp.com/send?text=${currentUrl}` :
                        `https://web.whatsapp.com/send?text=${currentUrl}`;
                }
            }
        }
    </script>
</x-modal>
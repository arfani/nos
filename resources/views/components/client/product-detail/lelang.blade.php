<x-client.product-detail.thumbnail-picture :product="$product" />

<div
    class="detail-product-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto md:flex-1 mb-6">
    <h1 class="text-center text-xl sm:text-2xl font-bold">
        {{ $product->name }}
        ( <span class="animate-pulse">DILELANG !!!</span> )
    </h1>

    <div class="divider">Berlaku Hingga</div>
    <div class="text-center text-info text-lg font-bold">
        {{ Carbon\Carbon::parse($product->auction->endtime)->isoFormat('LLL') }} ({{ config('app.timezone') }})
    </div>

    <div class="divider">
        Harga <i class="fa fa-hammer fa-flip-horizontal text-blue-500 text-2xl"></i>
    </div>
    <div class="mb-2">
        Harga Awal : <x-client.format-rp :value="$product->auction->bid_start" />
    </div>
    <div>
        Minimal Bid : <x-client.format-rp :value="$product->auction->bid_increment" />
    </div>

    <div class="divider">Ketentuan Lelang</div>
    <div>{!! $product->auction->rules !!}</div>

    {{-- MENGGUNKAN KONDISI JIKA PRODUCT_VARIANT > 1 KARENA PRODUK YANG TIDAK MEMILIKI VARIANT MEMILIKI 1 SAJA DATA DI
    TABEL PRODUCT VARIANT SEDANGKAN YANG MEMILIKI VARIANT AKAN MEMILIKI LEBIH DARI 1 DATA --}}
    @if (count($product->product_variant) > 1)
    <x-client.product-detail.variant :product="$product" />
    @endif

    @if ($product->detail_value->isNotEmpty())
        <div class="divider">Spesifikasi</div>
        @foreach ($product->detail_value as $detail)
            <div class="specification">
                <span>{{ $detail->detail->detail }}</span> : <span>{{ $detail->value }}</span>
            </div>
        @endforeach
    @endif

    @if ($product->dimention->length > 0 || $product->dimention->height > 0 || $product->dimention->weight > 0)
        <div class="divider">Dimensi</div>
            <div class="dimention">
                <div><span>Panjang</span> : <span>{{ $product->dimention->length }} cm</span></div>
                <div><span>Lebar</span> : <span>{{ $product->dimention->width }} cm</span></div>
                <div><span>Tinggi</span> : <span>{{ $product->dimention->height }} cm</span></div>
            </div>
    @endif

    <div class="divider">Deskripsi</div>
    <p>{!! $product->description !!}</p>
</div>

<div
    class="action-container rounded bg-base-200 shadow-xl text-base-content p-4 w-full h-fit sm:w-3/4 md:w-1/2 mx-auto md:mx-0 md:ml-auto lg:w-1/4">
    <h1>Informasi lelang</h1>
    <div class="divider"></div>

    <div class="flex flex-col items-start gap-2 mb-2">
        <span class="">Bid Tertinggi</span>
        <span class="bg-secondary text-secondary-content py-2 px-4 rounded">
            @if ($product->auction->bids->isNotEmpty())
                <x-client.format-rp :value="$product->auction->bids->first()->value" />
            @else
                -
            @endif
        </span>
    </div>
    <div class="flex items-center gap-2">
        <span class="">Oleh</span>
        <span class="bg-secondary text-secondary-content py-2 px-4 rounded">
            @if (auth()->user() && $product->auction->bids->isNotEmpty())
                {{ $product->auction->bids->first()->user_id === auth()->user()->id ? 'Anda' : $product->auction->bids->first()->user->name }}
            @else
                -
            @endif
        </span>
    </div>

    <div class="flex justify-center gap-3 mt-4">
        <div class="tooltip" data-tip="Bagikan">
            <button class="btn btn-ghost btn-sm text-lg" x-data
                @click.prevent="$dispatch('open-modal', 'share-product')"><i class="fa fa-share-nodes"></i>
            </button>
        </div>
        {{-- NANTI DITAMBAH FITUR WISHLIST ATAU FAVORITE --}}
        {{-- <div class="tooltip" data-tip="Favorit">
            <button class="btn btn-ghost btn-sm text-lg text-secondary"><i class="fa fa-heart-circle-plus"></i></button>
        </div> --}}
        <div class="tooltip" data-tip="Ikuti Lelang">
            <a href="#bidding" class="btn btn-ghost btn-sm text-lg" x-data
                @click="$store.auction.isCommentTab = false"><i class="fa fa-bullseye"></i></a>
        </div>
    </div>
</div>

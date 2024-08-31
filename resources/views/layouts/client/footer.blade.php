<footer class="footer p-10 bg-base-200 text-base-content">
    <nav class="md:mx-auto">
        <h6 class="footer-title tracking-widest">Belanja</h6>
        <a class="link link-hover" href="{{ route('client.how-to-order') }}">Cara belanja</a>
        <a class="link link-hover" href="{{ route('client.how-to-return') }}">Cara Pengembalian</a>
        <a class="link link-hover" href="{{ route('client.payment-method') }}">Metode Pembayaran</a>
    </nav>
    <nav class="md:mx-auto">
        <h6 class="footer-title tracking-widest">Link bermanfaat</h6>
        <a class="link link-hover" href="{{ route('client.promo') }}">Promo</a>
        <a class="link link-hover" href="{{ route('client.lelang') }}">Lelang</a>
    </nav>
    <nav class="md:mx-auto">
        <h6 class="footer-title tracking-widest">Cari tahu</h6>
        <a class="link link-hover" href="{{ route('client.about-us') }}">Tentang kami</a>
        <a class="link link-hover" href="{{ route('client.contact') }}">Kontak kami</a>
    </nav>
</footer>
<footer class="footer px-10 py-3 border-t bg-primary text-primary-content border-base-300">
    <aside class="items-center grid-flow-col">
        <span class="bg-white rounded p-2 hidden sm:block">
            <img src="{{ asset('assets/images/logo.webp') }}" alt="logo" width="50px" class="hidden sm:block">
        </span>
        <div class="flex flex-col">
            <p>Toko Online</p>
            <strong>DSComputer</strong>
        </div>
    </aside>
    <nav class="md:place-self-center md:justify-self-end">
        <div class="grid grid-flow-col gap-1">
            @foreach ($sosmed as $item)
                <a href="{{ $item->url }}" class="btn btn-circle bg-base-100 btn-sm">
                    <img src="{{ Storage::url($item->logo) }}" alt="{{ $item->name . 's logo' }}" width="20"
                        height="20">
                </a>
            @endforeach
        </div>
    </nav>
</footer>

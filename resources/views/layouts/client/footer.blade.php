<footer class="footer p-10 bg-base-200 text-base-content">
    <nav class="md:mx-auto">
        <h6 class="footer-title">Services</h6>
        <a class="link link-hover" href="{{ route('client.pages', 'branding') }}">Branding</a>
        <a class="link link-hover" href="{{ route('client.pages', 'design') }}">Design</a>
        <a class="link link-hover" href="{{ route('client.pages', 'marketing') }}">Marketing</a>
        <a class="link link-hover" href="{{ route('client.pages', 'advertisement') }}">Advertisement</a>
    </nav>
    <nav class="md:mx-auto">
        <h6 class="footer-title">Company</h6>
        <a class="link link-hover" href="{{ route('client.pages', 'about us') }}">About us</a>
        <a class="link link-hover" href="{{ route('client.pages', 'contact') }}">Contact</a>
        <a class="link link-hover" href="{{ route('client.pages', 'jobs') }}">Jobs</a>
        <a class="link link-hover" href="{{ route('client.pages', 'press kit') }}">Press kit</a>
    </nav>
    <nav class="md:mx-auto">
        <h6 class="footer-title">Legal</h6>
        <a class="link link-hover" href="{{ route('client.pages', 'terms of use') }}">Terms of use</a>
        <a class="link link-hover" href="{{ route('client.pages', 'privacy policy') }}">Privacy policy</a>
        <a class="link link-hover" href="{{ route('client.pages', 'cookie policy') }}">Cookie policy</a>
    </nav>
</footer>
<footer class="footer px-10 py-3 border-t bg-primary text-primary-content border-base-300">
    <aside class="items-center grid-flow-col">
        <img src="{{ asset('assets/images/logo.webp') }}" alt="logo" width="50px" class="hidden sm:block mr-2">
        <div class="flex flex-col">
            <p>Toko Online</p>
            <strong>DSComputer</strong>
        </div>
    </aside>
    <nav class="md:place-self-center md:justify-self-end">
        <div class="grid grid-flow-col gap-1">
            @foreach ($sosmed as $item)
            <a href="{{ $item->url }}" class="btn btn-circle bg-base-100 btn-sm">
                <img src="{{ Storage::url($item->logo) }}" alt="{{ $item->name.'s logo' }}" width="20" height="20">
            </a>
            @endforeach
        </div>
    </nav>
</footer>
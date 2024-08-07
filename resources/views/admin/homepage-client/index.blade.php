<x-app-layout>
    <x-ar.alert />
    <div class="flex flex-col gap-4">
        <x-ar.homepage-client :section="$hero" />
        <x-ar.homepage-client :section="$promo" />
        <x-ar.homepage-client :section="$auction" />
        <x-ar.homepage-client :section="$product" />
        <x-ar.homepage-client :section="$testimonial" />
        <x-ar.homepage-client :section="$faq" />
        <x-ar.homepage-client :section="$brand" />
    </div>
</x-app-layout>

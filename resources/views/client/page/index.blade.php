<x-client-layout :sosmed="$sosmed">
    <h1 class="text-xl lg:text-3xl mb-4">{{ $page->title }}</h1>
    {!! $page->content !!}
</x-client-layout>

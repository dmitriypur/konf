@push('header-scripts')
    <link rel="canonical" href="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

<x-app-layout title="{{ $page->seo['title'] ?? $page->title }}" description="{{ $page->seo['description'] }}">

    @foreach($page->blocks as $index => $block)
        <x-block
            :block="$block"
            pageTitle="{{ $page->title }}"
            pageDescription="{{ $page->seo['description'] }}"
        />
    @endforeach
</x-app-layout>

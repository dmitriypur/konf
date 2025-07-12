@push('header-scripts')
    <link rel="canonical" href="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

<x-app-layout title="{{ $page->seo['title'] ?? $page->title }}" description="{{ $page->seo['description'] }}">
{{--    <x-block.hero></x-block.hero>--}}
{{--    <x-block.about></x-block.about>--}}
{{--    <x-block.themes></x-block.themes>--}}
{{--    <x-block.programm></x-block.programm>--}}
{{--    <x-block.call-to-action></x-block.call-to-action>--}}
{{--    <x-block.tariffs></x-block.tariffs>--}}
{{--    <x-block.partners></x-block.partners>--}}
{{--    <x-block.location></x-block.location>--}}
{{--    <x-block.how-it-was></x-block.how-it-was>--}}

    @foreach($page->blocks as $index => $block)
        <x-block
            :block="$block"
            pageTitle="{{ $page->title }}"
            pageDescription="{{ $page->seo['description'] }}"
        />
    @endforeach
</x-app-layout>

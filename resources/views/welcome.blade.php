@push('header-scripts')
    <link rel="canonical" href="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
<x-app-layout title='III Национальная конференция "Оптика Будущего"'>
    <x-block.hero></x-block.hero>
    <x-block.about></x-block.about>
{{--    <x-block.themes></x-block.themes>--}}
{{--    <x-block.programm></x-block.programm>--}}
    <x-block.call-to-action></x-block.call-to-action>
    <x-block.tariffs></x-block.tariffs>
    <x-block.partners></x-block.partners>
    <x-block.location></x-block.location>
    <x-block.how-it-was></x-block.how-it-was>
</x-app-layout>

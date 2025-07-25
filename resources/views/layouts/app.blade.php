<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    @isset($description)
        <meta name="description" content="{{ $description }}">
    @endisset
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('header-scripts')
    <style>body { cursor: url({{ asset('images/cursor.cur') }}), url({{ asset('images/cursor.png') }}), pointer; }</style>
</head>
<body id="top" class="font-primary bg-no-repeat bg-linear-(--color-primary-gr) text-white">
<div class="w-full overflow-hidden">
    @include('partials.header')

    <main>
        {!! $slot !!}
    </main>

    @include('partials.footer')
</div>

</body>
</html>

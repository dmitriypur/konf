<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    @isset($description)
        <meta name="description" content="{{ $description }}">
    @endisset
    
    <!-- Мета-теги для производительности -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#1C1854">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.png') }}" type="image/png">
    
    <!-- Preload критических шрифтов только если они используются -->
    @if(request()->is('/'))
        <link rel="preload" href="{{ asset('fonts/Montserrat/Montserrat-Regular.woff2') }}" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="{{ asset('fonts/SoyuzGrotesk/SoyuzGrotesk.woff2') }}" as="font" type="font/woff2" crossorigin>
    @endif
    
    <!-- Preload критических изображений -->
    <link rel="preload" href="{{ asset('images/logo-header.svg') }}" as="image">
    
    <!-- Критические CSS стили -->
    <style>
        html { font-family: 'Arial', system-ui, sans-serif; }
        body { margin: 0; padding: 0; line-height: 1.6; }
        * { box-sizing: border-box; }
        .lazy { opacity: 0; transition: opacity 0.3s ease-in-out; }
        .lazy.loaded { opacity: 1; }
        
        /* Анимация появления изображений */
        img[data-src] {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        
        img[data-src].loaded {
            opacity: 1;
        }
        
        /* Fallback для изображений без lazy loading */
        img:not([data-src]) {
            opacity: 1;
        }
        
        /* Отступ для фиксированного меню */
        html {
            scroll-padding-top: 80px;
        }
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('header-scripts')
    <style>body { cursor: url({{ asset('images/cursor.svg') }}), auto; }</style>
</head>
<body id="top" class="font-primary bg-no-repeat bg-linear-(--color-primary-gr) text-white">
<div class="w-full overflow-hidden">
    @include('partials.header')

    <main>
        {!! $slot !!}
    </main>

    @include('partials.footer')
</div>

<script>
// Регистрация Service Worker только в production
if ('serviceWorker' in navigator && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1' && location.hostname !== '[::1]') {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                console.log('SW registered: ', registration);
            })
            .catch(registrationError => {
                console.log('SW registration failed: ', registrationError);
            });
    });
}

// Оптимизация изображений - поддержка WebP
document.addEventListener('DOMContentLoaded', function() {
    const supportsWebP = document.createElement('canvas')
        .toDataURL('image/webp')
        .indexOf('data:image/webp') === 0;
    
    if (supportsWebP) {
        document.querySelectorAll('img[data-webp]').forEach(img => {
            img.src = img.dataset.webp;
        });
    }
});
</script>

</body>
</html>

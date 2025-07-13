const CACHE_NAME = 'konf-landing-v2';
const urlsToCache = [
    '/',
    '/images/logo-header.svg',
    '/images/cursor.svg'
];

// Динамически добавляем assets в зависимости от окружения
const isDev = location.hostname === 'localhost' || location.hostname === '127.0.0.1' || location.hostname === '[::1]';
if (!isDev) {
    urlsToCache.push(
        '/build/assets/app.css',
        '/build/assets/app.js',
        '/fonts/Montserrat/Montserrat-Regular.woff2',
        '/fonts/Montserrat/Montserrat-Regular.woff',
        '/fonts/SoyuzGrotesk/SoyuzGrotesk.woff2',
        '/fonts/SoyuzGrotesk/SoyuzGrotesk.woff'
    );
}

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                // Добавляем ресурсы по одному, чтобы избежать ошибок
                const promises = urlsToCache.map(url => 
                    cache.add(url).catch(err => {
                        console.log('Failed to cache:', url, err);
                        return Promise.resolve();
                    })
                );
                return Promise.all(promises);
            })
    );
});

self.addEventListener('fetch', event => {
    // Пропускаем Vite dev сервер
    if (event.request.url.includes(':5173') || event.request.url.includes('localhost:5173')) {
        return;
    }
    
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                if (response) {
                    return response;
                }
                return fetch(event.request).catch(err => {
                    console.log('Fetch failed:', event.request.url, err);
                    // Возвращаем fallback для критических ресурсов
                    if (event.request.destination === 'image') {
                        return caches.match('/images/logo-header.svg');
                    }
                    return new Response('Network error', { status: 503 });
                });
            })
    );
});

self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
}); 
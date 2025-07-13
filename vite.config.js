import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        fs: {
            deny: ['storage']
        }
    },
    build: {
        minify: 'esbuild',
        rollupOptions: {
            output: {
                manualChunks: {
                    swiper: ['swiper'],
                    lazyload: ['vanilla-lazyload'],
                },
            },
        },
        chunkSizeWarningLimit: 1000,
    },
    optimizeDeps: {
        include: ['swiper', 'vanilla-lazyload'],
    },
});

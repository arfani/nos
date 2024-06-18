import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/client/home.css',
                'resources/css/admin/index.css',
                'resources/css/client/detail-product.css',
                'resources/js/app.js',
                'resources/js/client/countdown.js',
                'resources/js/client/detail-product.js',
                'resources/js/client/home.js',
            ],
            refresh: true,
        }),
    ],
});

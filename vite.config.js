import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/left_drawer.js',
                'resources/js/masthead.js',
                'resources/js/share.js',
                'resources/js/top_nav_scroll.js',
            ],
            refresh: true,
        }),
    ],
});

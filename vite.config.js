import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import livewire from '@defstudio/vite-livewire-plugin';

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
        livewire({
            refresh: ['resources/css/app.css'],
        }),
    ],
});

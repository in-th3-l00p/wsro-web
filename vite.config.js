import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/fontawesome/app.fontawesome', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});

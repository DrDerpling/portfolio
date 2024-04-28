import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['app/Domains/Frontend/resources/js/app.js', 'app/Domains/Frontend/resources/css/app.css'],
            refresh: true,
        }),
    ],
});

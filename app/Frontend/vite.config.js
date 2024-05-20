import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['app/Frontend/resources/js/app.js', 'app/Frontend/resources/css/app.css'],
            refresh: true,
        }),
    ],
});

import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['app/Modules/Frontend/resources/js/app.js', 'app/Modules/Frontend/resources/css/app.css'],
            refresh: true,
        }),
    ],
});

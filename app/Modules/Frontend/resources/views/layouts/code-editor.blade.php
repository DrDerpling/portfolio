<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('app/Modules/Frontend/resources/css/app.css')
    @livewireStyles
</head>
    <body class="theme-dark w-full" style="background-color: var(--main-bg-color); color: var(--main-text-color);">
        <div class="flex">
            <x-navigation-navbar/>
            <div class="flex flex-col flex-1 h-screen">
                <livewire:navigation.components.history/>
                <div class="flex parent-container h-screen overflow-y-auto">
                    <x-line-numbers line-height="25" height="90" />
                    <div class="p-4 ml-8 container">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <button onclick="toggleTheme()">Toggle Theme</button> <!-- Toggle button -->

        @vite('app/Modules/Frontend/resources/js/app.js')
        @livewireScripts

        <script>
            function toggleTheme() {
                const isLight = document.body.classList.toggle('theme-light');
                localStorage.setItem('theme', isLight ? 'light' : 'dark');
            }
            // Check for stored theme preference and apply it
            document.addEventListener('DOMContentLoaded', () => {
                if (localStorage.getItem('theme') === 'light') {
                    document.body.classList.add('theme-light');
                }
            });
        </script>
    </body>
</html>

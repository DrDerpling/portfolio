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
        <div class="flex flex-col h-screen"> <!-- Uses full screen height -->
            <div class="flex flex-1 overflow-hidden"> <!-- Content area flex container -->
                <x-navigation-navbar/>
                <div class="flex flex-col flex-1 overflow-y-auto"> <!-- Main content flex container -->
                    <livewire:navigation.components.history/>
                    <div class="flex flex-1 overflow-hidden">
                        <x-line-numbers line-height="25" height="90"/>
                        <div class="p-4 ml-8 flex-1">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <!-- Settings button as a fixed bar at the bottom -->
            <div class="w-full text-center p-2 fixed bottom-0 left-0 z-10 border-t"
                 style="background-color: var(--main-bg-color); border-color: var(--code-line-color) ">
                <x-settings-button/>
            </div>
        </div>

        <x-settings-modal/>
        @vite('app/Modules/Frontend/resources/js/app.js')
        @livewireScripts
    </body>
</html>

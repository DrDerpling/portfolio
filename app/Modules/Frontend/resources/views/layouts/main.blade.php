<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dennis Portfolio</title>
    @vite('app/Modules/Frontend/resources/css/app.css')
    @livewireStyles
</head>
    <body class="bg-primary h-screen overflow-hidden text-primary-content">

        <!-- Topbar -->
        <header class="flex bg-primary-darkest ease-in transition-colors">
            <x-navigation-top-bar/>
        </header>

        <div class="flex flex-1 overflow-hidden">

            <!-- Sidebar -->
            <aside class="bg-primary-darker w-64 p-4 hidden md:block flex-shrink-0 transition-colors">
                <x-navigation-sidebar/>
            </aside>

            <!-- Main Content -->
            <main class="h-content flex flex-1 p-4 overflow-y-auto">
                <x-line-numbers line-height="24"/>
                <div class="container pl-8 p-4 mx-auto">
                    @yield('content')
                </div>
            </main>

        </div>

        <!-- Bottombar -->
        <footer class="p-2 border-t bg-secondary-bottom-bar border-primary-darkest">
            <x-settings-button/>
        </footer>

        <!-- Mobile Sidebar -->
        <x-navigation-mobile-sidebar/>

        <div x-data="{ open: false }"
             :class="{ 'hidden': !open }"
             @toggle-settings-modal.window="open = !open"
             class="fixed hidden inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <x-settings-modal/>
        </div>

        @vite('app/Modules/Frontend/resources/js/app.js')
        @livewireScripts
    </body>
</html>

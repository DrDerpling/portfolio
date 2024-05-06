<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @vite('app/Modules/Frontend/resources/css/app.css')
    </head>
    <body class="w-full">
        <div class="flex bg-deep-gray text-white lg:h-screen">
            <x-navbar></x-navbar>
            <div class="flex flex-col flex-1 h-screen">
                <div class="flex items-center justify-between h-16 min-h-16 bg-charcoal">

                </div>
                <div class="flex parent-container h-screen overflow-y-auto">
                   <x-line-numbers line-height="25" height="90" />
                   <div class="p-4 ml-8 container">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>
        @vite('app/Modules/Frontend/resources/js/app.js')
        @yield('scripts')
    </body>
</html>

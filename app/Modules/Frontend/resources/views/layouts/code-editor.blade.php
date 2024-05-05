<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @vite('app/Modules/Frontend/resources/css/app.css')
    </head>
    <body class="m-0 h-screen">
        <div class="flex h-full bg-deep-gray text-white">
            <x-navbar></x-navbar>
            <div class="line-numbers p-4 flex flex-col text-slate">
                <!-- Line numbers will be generated here -->
            </div>

            <!-- Page Content -->
            <div class="px-4">
                @yield('content')
            </div>
        </div>
        @vite('app/Modules/Frontend/resources/js/app.js')
        @yield('scripts')
    </body>
</html>

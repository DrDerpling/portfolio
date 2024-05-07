<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @vite('app/Modules/Frontend/resources/css/app.css')
        @livewireStyles
    </head>
    <body class="w-full">
        <div class="flex bg-deep-gray text-white lg:h-screen">
            <x-navbar></x-navbar>
            <div class="flex flex-col flex-1 h-screen">
                <div x-data="{
                    links: [],
                    init() {
                        this.links = JSON.parse(localStorage.getItem('visitedLinks')) || [];
                    },
                    removeItem(index) {
                        this.links.splice(index, 1);
                        localStorage.setItem('visitedLinks', JSON.stringify(this.links));
                    }
                }" x-init="init" class="flex items-end flex-end h-16 min-h-16 bg-charcoal" >
                    <template x-for="(link, index) in links">
                        <div class="px-2 py-1 border-t-2 border-t border-t-bright-cyan border-x border-x-slate">
                            <a  x-text="link.title" :href="link.link" class="text-white"></a>
                            <button x-on:click="removeItem(index)">x</button>
                        </div>
                    </template>
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
        @livewireScripts
    </body>
</html>

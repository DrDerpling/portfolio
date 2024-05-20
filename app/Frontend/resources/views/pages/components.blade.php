@extends('layouts.main')

@section('content')
    <h1 class="text-5xl">Components</h1>
    <div class="py-4 lg:space-x-4 lg:space-y-2 space-y-4 flex flex-col lg:flex-row">
        <div>
            <h2 class="text-3xl pb-4">Line Numbers</h2>
            <div class="relative h-40 p-4 border-primary-darkest border">
                <x-line-numbers height="100" line-height="40"/>
            </div>
        </div>

        <div>
            <h2 class="text-3xl pb-4 bg-primary">History</h2>
            <div class="bg-primary-darkest shadow-lg">
                <livewire:navigation.components.history :history="$history"/>
            </div>
        </div>

        <div>
            <h2 class="text-3xl pb-4">Navbar</h2>
            <div class="p-4 w-64 bg-primary-darker">
                <x-navigation-sidebar/>
            </div>
        </div>
    </div>
    <div class="py-4 lg:space-x-4 lg:space-y-0 space-y-2 flex flex-col lg:flex-row">
        <div class="w-full bg-primary">
            <h2 class="text-3xl pb-4">Skills & expertise</h2>
            <x-skill-overview :skills="$skills"/>
        </div>
    </div>
    <div class="py-4 lg:space-x-4 lg:space-y-0 space-y-2 flex flex-col lg:flex-row">
        <div class="w-full">
            <h2 class="text-3xl pb-4">Settings Modal</h2>
            <x-settings-modal/>
        </div>
    </div>
    <div class="py-4 lg:space-x-4 lg:space-y-0 space-y-2 flex flex-col lg:flex-row">
        <div class="w-full">
            <h2 class="text-3xl pb-4">Projects</h2>
            <x-project-slider :projects="$projects"/>
        </div>
    </div>

    <div class="py-4 lg:space-x-4 lg:space-y-0 space-y-2 flex flex-col lg:flex-row">
        <div class="w-full">
            <h2 class="text-3xl pb-4">Packages</h2>
            <x-package-overview :packages="$packages"/>
        </div>
@endsection

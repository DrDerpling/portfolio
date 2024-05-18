@extends('layouts.main')

@section('content')
    <h1 class="text-5xl">Hello Travel!</h1>
    <p class="text-lg">We are busy initializing the project.</p>
    <p class="text-lg">In a few seconds, you will see a button. We are currently retrieving data from our content management system to provide you with the latest information.</p>

    <!-- Alpine.js Component for Delayed Button Display with Page Refresh -->
    <div x-data="{ showButton: false }" x-init="setTimeout(() => showButton = true, 2000)">
        <button
            x-show="showButton"
            @click="window.location.reload()"
            class="ml-2 w-1/3 p-2 rounded bg-secondary text-darkest">
            Refresh Page
        </button>
    </div>
@endsection

@extends('layouts.code-editor')

@section('content')
    <h1 class="text-5xl">Components</h1>
    <div class="flex space-x-4 pt-4">
        <div>
            <h2 class="text-3xl">Skills</h2>
            <div class="bg-charcoal">
                @foreach($skills as $skill)
                    <x-skill :skill="$skill"></x-skill>
                @endforeach
            </div>
        </div>

        <div>
            <h2 class="text-3xl">Navbar</h2>
            <div class="bg-charcoal">
                <x-navbar></x-navbar>
            </div>
        </div>
    </div>
@endsection

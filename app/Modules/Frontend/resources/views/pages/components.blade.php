@extends('layouts.code-editor')

@section('content')
    <h1 class="text-5xl">Components</h1>
    <div class="pt-4 lg:space-x-2  lg:space-y-0 space-y-2 flex flex-col lg:flex-row">
        <div class="p-4 lg:w-1/3 bg-dark-navy border-2 border-charcoal">
            <h2 class="text-3xl pb-4">Skills</h2>
            <div>
                @foreach($skills as $skill)
                    <x-skill :skill="$skill"></x-skill>
                @endforeach
            </div>
        </div>

        <div class="p-4 lg:w-1/3 bg-dark-navy border-2 border-charcoal">
            <h2 class="text-3xl pb-4">Line Numbers</h2>
            <div class="relative h-40">
                <x-line-numbers height="100" line-height="26"/>
            </div>
        </div>

        <div class="p-4 lg:w-1/3 bg-deep-gray border-2 border-charcoal">
            <h2 class="text-3xl pb-4">Navbar</h2>
            <div>
                <x-navbar forceVisible="true"></x-navbar>
            </div>
        </div>
    </div>
@endsection

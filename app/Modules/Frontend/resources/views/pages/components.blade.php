<head>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    @vite('app/Modules/Frontend/resources/css/app.css')
</head>
<body>
<div class="container mx-auto px-4">


    <!-- Page Content -->
    <div class="px-4">
        <h1 class="text-5xl">Components</h1>


        <h2 class="text-3xl">Skills</h2>
        @foreach($skills as $skill)
            <x-skill :skill="$skill"></x-skill>
        @endforeach

        <h2 class="text-3xl">Navbar</h2>
        <x-navbar></x-navbar>
    </div>

    @vite('app/Modules/Frontend/resources/js/app.js')
</div>
</body>

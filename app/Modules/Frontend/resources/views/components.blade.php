<head>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    @vite('app/Modules/Frontend/resources/css/app.css')
</head>
<body>
<div class="container mx-auto px-4">
    <nav class="bg-white border-gray-200 px-4 mb-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <a href="{{ route('home') }}"
                       class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white"
                       aria-current="page">Home</a>
                </li>
                <li>
                    <a href="{{ route('components') }}"
                       class="block py-2 pr-4 pl-3 text-gray-700 border-gray-100 rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white">Components</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="px-4">
        <h1 class="text-5xl">Components</h1>

        @foreach($skills as $skill)
            <x-skill :skill="$skill"></x-skill>
        @endforeach
    </div>

    @vite('app/Modules/Frontend/resources/js/app.js')
</div>
</body>

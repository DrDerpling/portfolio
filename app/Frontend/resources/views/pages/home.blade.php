@extends('layouts.main')

@section('content')
    <div class="xl:pt-64 xl:pb-64 pb-32">
        <x-partials.intro/>
    </div>

    <x-partials.about-me/>

    <div class="lg:pb-32 pb-12">
        <p class="text-lg text-secondary mb-2">TECHNOLOGIES</p>
        <h2 class="text-4xl font-bold mb-4">This is what i know</h2>
        <x-skill-overview :skills="$skills"/>
    </div>

    <div class="lg:pb-32 pb-12">
        <p class="text-lg text-secondary mb-2">PROJECTS</p>
        <h2 class="text-4xl font-bold mb-4">Here you can see some of my work</h2>
        <p class="text-lg mb-6">
            Over the years, I have worked on numerous projects that showcase my skills in developing efficient and
            scalable web applications. Each project highlights my ability to integrate complex systems and deliver
            high-quality solutions that meet the needs of diverse clients. Below are some of the projects I've been
            involved in:
        </p>
        <x-project-slider :projects="$projects"/>
    </div>

    <div class="lg:pb-32 pb-12">
        <p class="text-lg text-secondary mb-2">PACKAGES</p>
        <h2 class="text-4xl font-bold mb-4">These are things i shared</h2>
        <x-package-overview :packages="$packages"/>
    </div>

@endsection

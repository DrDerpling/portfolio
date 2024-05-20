@php
    /** @var \App\Modules\Project\Models\Project $project */
@endphp

<div class="bg-primary-darker flex flex-col h-full shadow-lg">
    <div class="flex-grow">
        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }} Interface"
             class="h-48 w-full object-cover bg-primary-darkest border-b-2 border-primary-darkest"> <!-- Ensure the image fills the width and is contained properly -->
        <div class="p-4">
            <h2 class="font-semibold text-xl text-primary-lighter mb-2">{{ $project->name }} </h2>
            <p class="text-primary-lighter text-base">{{ Str::limit($project->short_description, 300) }}</p> <!-- Use 'truncate' if you prefer it over 'overflow-hidden' for better text handling -->
        </div>
    </div>

    <div class="mt-auto p-4">
        <div class="flex flex-wrap gap-2 mb-4">
            @foreach($project->skills->take(4) as $skill)
                <x-badge>#{{ $skill->name }}</x-badge>
            @endforeach
        </div>
        <div class="flex justify-between items-center">
            <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a> <!-- Assuming a dynamic URL for 'Read More' based on project slug -->
            <a href="{{ $project->url ?? '' }}" target="_blank"
               class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit Website</a>
        </div>
    </div>
</div>


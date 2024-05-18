@php
    /** @var array{
    *               id: int,
    *               title: string,
    *               description: string,
    *               image: string,
    *               badges:array,
    *               url:string
     *          } $project
     */
@endphp

<div class="bg-primary-darker flex flex-col h-full">
    <div class="flex-grow">
        <img src="{{ $project['image'] }}" alt="{{ $project['title'] }} Interface"
             class="h-48 w-full object-cover bg-primary-darkest"> <!-- Ensure the image fills the width and is contained properly -->
        <div class="p-4">
            <h2 class="font-semibold text-xl text-primary-lighter mb-2">{{ $project['title'] }}</h2>
            <p class="text-primary-lighter text-base mb-4 truncate">{{ Str::limit($project['description'], 300) }}</p> <!-- Use 'truncate' if you prefer it over 'overflow-hidden' for better text handling -->
        </div>
    </div>

    <div class="mt-auto p-4">
        <div class="flex flex-wrap gap-2 mb-4"> <!-- Increased gap for better visual separation -->
            @foreach($project['badges'] as $badge)
                <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#{{ $badge }}</span>
            @endforeach
        </div>
        <div class="flex justify-between items-center">
            <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a> <!-- Assuming a dynamic URL for 'Read More' based on project slug -->
            <a href="{{ $project['url'] ?? '' }}" target="_blank"
               class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit Website</a>
        </div>
    </div>
</div>


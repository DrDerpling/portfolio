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

<div class="flex flex-col h-full">
    <img src="{{ $project['image'] }}" alt="Project Gezond App Interface"
         class="w-full h-48 object-contain flex-shrink-0">
    <div class="p-4 flex-col bg-primary-darker flex justify-between flex-1">
        <h2 class="font-semibold text-xl text-primary-lighter mb-2"> {{  $project['title'] }}</h2>
        <p class="text-primary-lighter text-base mb-4 overflow-hidden">
            {{ Str::limit($project['description'], 300)}}
        </p>
        <div class="flex flex-wrap gap-1 items-start mb-4 overflow-hidden">
            @foreach($project['badges'] as $badge)
                <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#{{ $badge }}</span>
            @endforeach
        </div>
        <div class="flex justify-between items-center">
            <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a>
            <a href="{{ $project['url'] }}" target="_blank"
               class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit
                Website</a>
        </div>
    </div>
</div>
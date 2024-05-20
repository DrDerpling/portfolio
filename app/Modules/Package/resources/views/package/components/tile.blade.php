@php
    /** @var \App\Modules\Package\Models\Package $package */
@endphp

<a href="{{ $package->url }}"
   class="block relative text-primary-lightest hover:shadow-lg transition-shadow duration-300 overflow-hidden">
    <div class="relative w-full h-64 bg-cover bg-center"
         style="background-image: url({{ asset('storage/' . $package->image) }});">
        <div class="absolute w-full h-full bg-black bg-opacity-50 flex flex-col justify-between p-4">
            <div class="flex-1 flex items-center justify-center">
                <h2 class="font-bold text-xl text-center">{{ $package->name }}</h2>
            </div>
            <div class="text-sm mt-2">
                <p>{{ $formatProjectStats()  }}</p>
                <p>Last update: {{ $lastUpdatedFormatted() }}</p>
            </div>
            <div class="flex justify-between items-end w-full">
                <div>
                    <span>{{ $downloadsFormatted() }}</span> ·
                    <span>{{ $starsFormatted() }}</span>
                </div>
                <x-badge>{{ $package->version }}</x-badge>
            </div>
        </div>
    </div>
</a>
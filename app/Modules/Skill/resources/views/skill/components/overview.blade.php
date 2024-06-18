@php
    /** @var \Illuminate\Support\Collection $groupedSkills */
@endphp

<div class="w-full text-primary bg-primary-darker border-primary-darkest border-t flex justify-center">
    <div class="bg-primary text-primary-content sm:p-4 lg:p-6 w-full lg:max-w-4xl mx-auto">
        @foreach($groupedSkills as $group => $skills)
            <div class="mb-4">
                <h3 class="font-semibold text-lg mb-2">{{ $group }}</h3>
                <!-- Responsive grid setup: 2 columns on mobile, 4 on tablets, 6 on desktop -->
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2 md:gap-4">
                    @foreach($skills as $skill)
                        <div class="flex flex-col justify-between text-center shadow-lg">
                            <div class="bg-primary-darker p-2">
                                <img src="{{ asset('storage/' . $skill->logo) }}" alt="{{ $skill->name }}" class="h-20 w-20 mx-auto">
                            </div>
                            <div class="bg-primary-darkest text-primary-lighter p-2">
                                <p class="text-sm">{{ $skill->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

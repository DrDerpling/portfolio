@php use Illuminate\Database\Eloquent\Casts\Json; @endphp
<div
        class="mx-auto relative"
        x-data="{ activeSlide: 1, slides: {{ Json::encode($slides) }} }"
>
    <!-- Slides -->

    @foreach($projectsChunks as $index => $projectChunk)
        <div x-show="activeSlide === {{ $index +1 }}" :key="{{ $index }}" class="py-4 flex items-center">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($projectChunk as $project)
                    <x-project-card key="{{ $project['id'] }}" :project="$project"/>
                @endforeach
            </div>
        </div>
    @endforeach

    <!-- Buttons -->
    <div class="absolute w-full flex items-center justify-center">
        <div class="flex items-center justify-start">
            <button
                    class="border border-primary-darkest text-primary hover:bg-secondary hover:text-darkest hover:shadow-lg rounded-md px-4 py-2"
                    x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                <x-feather-icon name="chevron-left" class="h-6 w-6"/>
            </button>
        </div>
        <template x-for="slide in slides" :key="slide">
            <button
                    class="flex-1 w-4 h-2 mx-2 mb-0 rounded overflow-hidden transition-colors duration-200 ease-out hover:opacity-50 hover:bg-secondary hover:shadow-lg"
                    :class="{
              'bg-secondary': activeSlide === slide,
              'bg-primary-darkest': activeSlide !== slide
          }"
                    x-on:click="activeSlide = slide"
            ></button>
        </template>
        <div class="flex items-center justify-end">
            <button
                    class="border border-primary-darkest text-primary hover:bg-secondary hover:text-primary-lighter hover:shadow-lg rounded-md px-4 py-2"
                    x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                <x-feather-icon name="chevron-right" class="h-6 w-6"/>
            </button>
        </div>
    </div>
</div>


{{--<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">--}}
{{--    <!-- Card 1: Just Carpets -->--}}


<!-- Card 2: Bunzlau Castle -->


{{--    <!-- Card 3: Project Gezond -->--}}

{{--</div>--}}

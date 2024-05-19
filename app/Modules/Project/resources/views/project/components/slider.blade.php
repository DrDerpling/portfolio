<div class="w-full">
    <div x-data="slider()" x-init="init">
        <div x-ref="container"
             class="flex overflow-x-auto snap-x snap-mandatory touch-pan-x scroll-smooth">
            @foreach($projects as $project)
                <div class="snap-start flex-none w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                    <x-project-card :project="$project"/>
                </div>
            @endforeach
        </div>
        <div x-ref="navigation" class="hidden lg:flex justify-between py-2">
            <button  @click="previousSlide">
                <x-feather-icon name="chevron-left" class="h-6 w-6"/>
            </button>
            <button @click="previousSlide">
                <x-feather-icon name="chevron-right" class="h-6 w-6"/>
            </button>
        </div>
    </div>
</div>

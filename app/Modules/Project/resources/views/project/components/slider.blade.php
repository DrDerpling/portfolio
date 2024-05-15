<div class="w-full">
    <div x-data="slider()" x-init="init" class="overflow-hidden mx-auto max-w-80 md:max-w-screen-md lg:max-w-screen-2xl">
        <div x-ref="container"
             class="flex overflow-x-auto lg:overflow-x-hidden snap-x snap-mandatory touch-pan-x scroll-smooth">
            @foreach($projects as $project)
                <div class="snap-start flex-none w-full md:w-1/2 lg:w-1/3 p-2 lg:p-4">
                    <x-project-card :project="$project"/>
                </div>
            @endforeach
        </div>
        <div class=" hidden lg:flex justify-between">
            <button @click="prev">
                <x-feather-icon name="chevron-left" className="h-6 w-6"/>
            </button>
            <button @click="next">
                <x-feather-icon name="chevron-right" className="h-6 w-6"/>
            </button>
        </div>
    </div>
</div>

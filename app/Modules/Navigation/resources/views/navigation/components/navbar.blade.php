@php
    /** @var \App\Modules\Navigation\DataObjects\LinkItem[]|\App\Modules\Navigation\Livewire\Navigation\LinkGroup[] $links */
    /** @var bool $forceVisible */
    use App\Modules\Navigation\Models\LinkGroup;
@endphp
<div x-data="{ open: false }" @keydown.escape.window="open = false">
    <aside
            @toggle-sidebar.window="open = !open"
            @close-sidebar.window="open = false"
            @open-sidebar.window="open = true"
            :class="open ? 'translate-x-0 z-30' : '-translate-x-full z-10'"
            class="transform top-0 left-0 w-64 bg-primary-darker fixed h-full overflow-auto ease-in-out
              border-r lg:border-r-0 border-primary-darkest
              shadow-xl lg:shadow-none
              transition-all duration-300 lg:translate-x-0 lg:static lg:block pointer-events-auto"
            @click.stop="">
        <div class="flex px-4 items-start justify-center flex-col h-16 min-h-16 text-primary-lighter bg-primary-darkest">
            <x-feather-icon name="x" className="absolute top-4 right-4 cursor-pointer lg:hidden h-8 w-8"
                            @click="open = false"/>
            <strong>Dennis Lindeboom</strong>
            <em class="text-xs text-primary-darker">Backend Developer</em>
        </div>
        <div class="py-4 pl-4 pr-6">
            @foreach($links as $link)
                @if($link instanceof LinkGroup)
                    <livewire:navigation.components.link-group :key="$link->id" :link-group="$link"
                                                               :open="$link->hasActiveChildren()"/>
                    @continue
                @endif

                <livewire:navigation.components.link-item :key="$link->getLabel()" hidden="false" :link="$link"/>
            @endforeach
        </div>
    </aside>

    <!-- Overlay that covers the whole screen, closes sidebar when clicked -->
    <div x-show="open" @click="open = false" x-cloak
         class="fixed inset-0 bg-black opacity-30 z-20 ease-in-out transition-opacity duration-300"></div>
</div>

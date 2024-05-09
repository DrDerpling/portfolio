@php
    /** @var \App\Modules\Navigation\Models\LinkGroup $linkGroup */
    /** @var bool $open */
    /** @var bool $active */
@endphp

<div x-data="{
        open: $wire.entangle('open'),
        active: $wire.entangle('active'),
    }" wire:loading.remove x-cloak>
    <div @click="open = !open" class="flex cursor-pointer items-center"
         :class="{ 'font-bold': active, 'font-normal': !active }"
         :style="`color: ${active ? 'var(--active-group-nav)' : 'var(--inactive-group-nav)'}`">
        <div x-show="!open">
            <x-feather-icon x-show="open" name="chevron-right" class="h-4 w-4"/>
        </div>
        <div x-show="open">
            <x-feather-icon name="chevron-down" class="h-4 w-4"/>
        </div>

        <x-feather-icon name="folder" class="h-4 w-4 ml-1"/>
        <span class="ml-1">{{ $linkGroup->name }}</span>
    </div>
    <div class="pl-8" x-show="open" style="color: var(--nav-text-inactive-color);">
        @foreach($linkGroup->children as $link)
            <livewire:navigation.components.link-item :key="$link->id" :link="$link"
                                                      :hidden="false"/>
        @endforeach
    </div>

</div>

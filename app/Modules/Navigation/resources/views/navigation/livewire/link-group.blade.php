@php
    /** @var \App\Modules\Navigation\Models\LinkGroup $linkGroup */
    /** @var bool $open */
@endphp

<div x-data="{
        open: $wire.entangle('open'),
        active: false
    }" wire:loading.remove x-cloak>
    <div @click="open = !open" class="flex cursor-pointer items-center" :class="active ? '' : 'text-cool-gray-400'">
        <div x-show="!open">
            <x-feather-icon x-show="open" name="chevron-right" className="h-4 w-4"/>
        </div>
        <div x-show="open">
            <x-feather-icon name="chevron-down" className="h-4 w-4"/>
        </div>

        <x-feather-icon name="folder" className="h-4 w-4 ml-1"/>
        <span class="ml-1">{{ $linkGroup->name }}</span>
    </div>
    <div class="pl-8" x-show="open">
        @foreach($linkGroup->children as $link)
            <livewire:navigation.components.link-item :key="$link->id" :link="$link"
                                                      :hidden="false"/>
        @endforeach
    </div>
</div>


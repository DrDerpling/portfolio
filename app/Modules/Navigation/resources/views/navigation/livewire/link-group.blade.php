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
         :class="{ 'font-bold text-primary-lighter': active, 'font-normal text-primary-darker': !active }">
        <div x-show="!open">
            <x-feather-icon x-show="open" name="chevron-right" className="h-5 w-5 stroke-2"/>
        </div>
        <div x-show="open">
            <x-feather-icon name="chevron-down" className="h-5 w-5 stroke-2"/>
        </div>

        <x-feather-icon name="folder" className="h-5 w-5 stroke-2 text-primary-darker"/>
        <span class="ml-1">{{ $linkGroup->name }}</span>
    </div>
    <div class="pl-8 text-primary-darker" x-show="open">
        @foreach($linkGroup->children as $link)
            <livewire:navigation.components.link-item :key="$link->id" :link="$link"
                                                      :hidden="false"/>
        @endforeach
    </div>

</div>

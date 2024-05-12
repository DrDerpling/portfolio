@php
    /** @var \App\Modules\Navigation\Models\LinkItem[] $history */
@endphp

<div class="flex lg:items-end h-16 min-h-16 overflow-hidden">
    @foreach($history as $index => $link)
        @php
            $isActive = $link->is_active;
            $containerClass = $isActive ? 'active-link-item' : 'link-item-container';
            $buttonClass = $isActive ? 'link-item-button active' : 'link-item-button';
        @endphp

        <div class="{{ $containerClass }} flex items-center px-2 py-1">
            <a href="{{ $link->getUrl() }}" class="flex items-center" wire:navigate.hover>
                <x-feather-icon name="{{ $link->icon }}" className="h-4 w-4 mr-2"/>
                {{ $link->name }}
            </a>
            <button class="{{ $buttonClass }} ml-1" wire:click="removeItem(@js($index))">
                <x-feather-icon name="x" className="h-5 w-5 stroke-1 hover:stroke-2"/>
            </button>
        </div>
    @endforeach
</div>


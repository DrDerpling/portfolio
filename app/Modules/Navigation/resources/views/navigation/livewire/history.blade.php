@php
    /** @var \App\Modules\Navigation\Models\LinkItem[] $history */
@endphp

<div class="flex items-end h-16 min-h-16" style="background-color: var(--secondary-sidebar-bg-color);">
    @foreach($history as $index => $link)
        @php
            $isActive = $link->isActive();
            $containerClass = $isActive ? 'active-link-item' : 'link-item-container';
            $buttonClass = $isActive ? 'link-item-button active' : 'link-item-button';
        @endphp

        <div class="{{ $containerClass }} flex items-center px-2 py-1">
            <a href="{{ $link->getUrl() }}" wire:navigate.hover>
                {{ $link->name }}
            </a>
            <button
                class="ml-1 h-4 w-4 {{ $buttonClass }}"
                wire:click="removeItem(@js($index))">
                <x-feather-icon name="x" className="h-4 w-4"/>
            </button>
        </div>
    @endforeach
</div>

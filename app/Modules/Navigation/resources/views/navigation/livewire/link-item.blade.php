@php
    /** @var \App\Modules\Navigation\Models\LinkItem $link */
    /** @var bool $hidden */

    $isActiveClass = $link->isActive() ? 'text-bright-cyan' : '';
    $hiddenClass = $hidden ? 'hidden' : '';
@endphp

<div>
    <a wire:navigate.hover
       class="flex items-center space-x-1 {{ $isActiveClass }} {{ $hiddenClass }}"
       href="{{ $link->getUrl() }}">
        <x-feather-icon name="{{ $link->icon }}" className="h-4 w-4"/>
        <span>
            {{ $link->name }}
        </span>
    </a>
</div>


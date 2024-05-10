@php
    /** @var \App\Modules\Navigation\Models\LinkItem $link */
    /** @var bool $hidden */

    $isActive = $link->isActive();
    $isActiveClass = $isActive ? 'text-secondary' : '';
    $hiddenClass = $hidden ? 'hidden' : '';
@endphp

<div>
    <a wire:navigate.hover
       class="flex items-center space-x-1 {{ $isActiveClass }} {{ $hiddenClass }}"
       href="{{ $link->getUrl() }}">
        <x-feather-icon name="{{ $link->icon }}" className="h-5 w-5 stroke-2 text-primary-darker"/>
        <span>
            {{ $link->name }}
        </span>
    </a>
</div>

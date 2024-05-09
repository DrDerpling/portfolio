@php
    /** @var \App\Modules\Navigation\Models\LinkItem $link */
    /** @var bool $hidden */

    $isActive = $link->isActive();
    $isActiveClass = $isActive ? 'text-active-nav-text' : 'text-inactive-nav-text';
    $hiddenClass = $hidden ? 'hidden' : '';
@endphp

<div>
    <a wire:navigate.hover
       class="flex items-center space-x-1 {{ $isActiveClass }} {{ $hiddenClass }}"
       href="{{ $link->getUrl() }}"
       style="color: {{ $isActive ? 'var(--active-nav-text)' : 'var(--nav-text-inactive-color)' }}">
        <x-feather-icon name="{{ $link->icon }}" class="h-4 w-4"/>
        <span>
            {{ $link->name }}
        </span>
    </a>
</div>

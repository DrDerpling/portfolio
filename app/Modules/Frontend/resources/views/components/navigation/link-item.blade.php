@php
    /** @var \App\Modules\Frontend\DataObjects\NavigationLink $link */
    /** @var bool $hidden */

    $isActiveClass = $link->isActive() ? 'text-bright-cyan' : '';
    $hiddenClass = $hidden ? 'hidden' : '';
@endphp

<div>
    <a wire:navigate data-menu-item class="flex items-center space-x-1 {{ $isActiveClass }} {{ $hiddenClass }}" href="{{ $link->getUrl() }}">
        <x-feather-icon name="{{ $link->getIconName() }}" className="h-4 w-4"/>
        <span>
        {{ $link->getLabel() }}
    </span>
    </a>
</div>


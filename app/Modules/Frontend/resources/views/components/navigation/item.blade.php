@php
    /** @var \App\Modules\Frontend\DataObjects\NavigationLink $link */
    /** @var bool $hidden */

    $isActiveClass = $link->isActive() ? 'text-bright-cyan' : '';
    $hiddenClass = $hidden ? 'hidden' : '';
@endphp

@if($link->hasChildren())
    <x-parent-item :link="$link" :hidden="$hidden"/>
@endif

@if(!$link->hasChildren())
    <a data-menu-item class="flex items-center space-x-1 {{ $isActiveClass }} {{ $hiddenClass }}" href="{{ $link->getUrl() }}">
        <x-feather-icon name="{{ $link->getIconName() }}" className="h-4 w-4"/>
        <span>
            {{ $link->getLabel() }}
        </span>
    </a>
@endif



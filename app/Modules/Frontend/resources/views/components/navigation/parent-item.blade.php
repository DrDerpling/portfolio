@php
    /** @var \App\Modules\Frontend\DataObjects\NavigationLink $link */
    /** @var bool $hidden */

    $isActiveClass = $link->hasActiveChildren() ? 'text-cool-gray-400' : '';
    $hiddenClass = $hidden ? 'hidden' : '';

    if (!$link->hasChildren()) {
        throw new InvalidArgumentException('This component should only be used for parent links');
    }
@endphp

<div data-parent-menu-item class="flex cursor-pointer items-center {{ $isActiveClass }} {{ $hiddenClass }}">
    <x-feather-icon data-chevron name="chevron-right"
                    className="h-4 w-4 chevron {{ $link->hasActiveChildren() ? 'hidden' : '' }}"/>
    <x-feather-icon data-chevron name="chevron-down"
                    className="h-4 w-4 chevron {{ $link->hasActiveChildren() ? '' : 'hidden' }}"/>
    <x-feather-icon name="folder" className="h-4 w-4 ml-1"/>
    <span class="ml-1">{{ $link->getLabel() }}</span>
</div>

<div class="pl-8">
    @foreach($link->getChildren() as $childLink)
        <x-item :hidden="!$link->hasActiveChildren()" :link="$childLink"/>
    @endforeach
</div>


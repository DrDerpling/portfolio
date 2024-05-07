@php
    /** @var \App\Modules\Frontend\DataObjects\NavigationLink $link */
    /** @var bool $open */

    $isActiveClass = $link->hasActiveChildren() ? 'text-cool-gray-400' : '';

    if (!$link->hasChildren()) {
        throw new InvalidArgumentException('This component should only be used for parent links');
    }
@endphp

<div>
    <div wire:click="toggle" class="flex cursor-pointer items-center {{ $isActiveClass }}">
        <x-feather-icon data-chevron name="chevron-right"
                        className="h-4 w-4 chevron {{ $open ? 'hidden' : '' }}"/>
        <x-feather-icon data-chevron name="chevron-down"
                        className="h-4 w-4 chevron {{ $open ? '' : 'hidden' }}"/>
        <x-feather-icon name="folder" className="h-4 w-4 ml-1"/>
        <span class="ml-1">{{ $link->getLabel() }}</span>

    </div>
    <div class="pl-8">
        @foreach($link->getChildren() as $childLink)
            <x-navigation.link-item :key="$childLink->getLabel()" :link="$childLink"
                                           :hidden="!$open"/>
        @endforeach
    </div>
</div>


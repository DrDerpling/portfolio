@php
 /** @var \App\Modules\Navigation\Models\Link[]|\App\Modules\Navigation\Models\LinkGroup[] $links */
 /** @var \Illuminate\View\ComponentAttributeBag $attributes */
@endphp

<nav {{ $attributes->class([]) }}>
    @foreach($links as $link)
        @if($link instanceof \App\Modules\Navigation\Models\LinkGroup)

            <livewire:navigation.components.link-group :key="$link->id" :link-group="$link"
                                                       :open="$link->hasActiveChildren()"/>
            @continue
        @endif

        <livewire:navigation.components.link-item :key="$link->label" hidden="false" :link="$link"/>
    @endforeach
</nav>
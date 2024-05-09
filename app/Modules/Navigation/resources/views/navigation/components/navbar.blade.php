@php
    /** @var \App\Modules\Navigation\DataObjects\LinkItem[]|\App\Modules\Navigation\Livewire\Navigation\LinkGroup[] $links */
    /** @var bool $forceVisible */
    use App\Modules\Navigation\Models\LinkGroup;

    $hiddenClass = $forceVisible ? '' : 'hidden lg:block';
@endphp

<aside class="text-inactive-nav-text {{ $hiddenClass }}" style="background-color: var(--sidebar-bg-color);">
    <div class="flex px-4 items-start justify-center flex-col h-16 min-h-16" style="background-color: var(--secondary-sidebar-bg-color);">
        <strong class="text-active-nav-text">Dennis Lindeboom</strong> <!-- dynamic color for active text -->
        <em class="text-xs" style="color: var(--nav-text-inactive-color);">Backend Developer</em> <!-- dynamic color for inactive text -->
    </div>
    <div class="py-4 pl-4 pr-6">
        @foreach($links as $link)
            @if($link instanceof LinkGroup)
                <livewire:navigation.components.link-group :key="$link->id" :link-group="$link" :open="$link->hasActiveChildren()"/>
                @continue
            @endif

            <livewire:navigation.components.link-item :key="$link->getLabel()" hidden="false" :link="$link"/>
        @endforeach
    </div>
</aside>

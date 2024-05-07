@php
    /** @var \App\Modules\Frontend\DataObjects\NavigationLink[] $links */
    /** @var bool $forceVisible */

    $hiddenClass = $forceVisible ? '' : 'hidden lg:block';
@endphp

<aside class="bg-dark-navy text-cool-gray-500 {{ $hiddenClass }}">
    <div class="flex px-4 items-start justify-center flex-col h-16 min-h-16 bg-charcoal">
        <strong class="text-white">Dennis Lindeboom</strong>
        <em class="text-xs text-cool-gray-500">Backend Developer</em>
    </div>
    <div class="py-4 pl-4 pr-6">
        @foreach($links as $link)
            @if($link->hasChildren())
                <livewire:navigation.link-group :key="$link->getLabel()" :link="$link" :open="$link->hasActiveChildren()"/>
                @continue
            @endif

            <x-navigation.link-item :key="$link->getLabel()" :link="$link"/>
        @endforeach
    </div>

</aside>

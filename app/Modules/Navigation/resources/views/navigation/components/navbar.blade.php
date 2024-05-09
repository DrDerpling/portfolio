@php
    /** @var \App\Modules\Navigation\DataObjects\LinkItem[]|\App\Modules\Navigation\Livewire\Navigation\LinkGroup[] $links */
    /** @var bool $forceVisible */
    use App\Modules\Navigation\Models\LinkGroup;

    $hiddenClass = $forceVisible ? '' : 'hidden lg:block';
@endphp

<aside class="bg-dark-navy text-cool-gray-500 {{ $hiddenClass }}">
    <div class="flex px-4 items-start justify-center flex-col h-16 min-h-16 bg-charcoal">
        <strong class="text-white">Dennis Lindeboom</strong>
        <em class="text-xs text-cool-gray-500">Backend Developer</em>
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

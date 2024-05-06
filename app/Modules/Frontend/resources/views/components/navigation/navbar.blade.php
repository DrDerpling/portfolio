@php
    /** @var \App\Modules\Frontend\DataObjects\NavigationLink[] $links */
    /** @var bool $forceVisible */

    $hiddenClass = $forceVisible ? '' : 'hidden lg:block';
@endphp

<aside class="bg-dark-navy text-cool-gray-500 {{ $hiddenClass }}">
    <div class="flex items-center justify-center h-16 bg-charcoal">

    </div>
    <div class="py-4 pl-4 pr-6">
        @foreach($links as $link)
            <x-item :link="$link"/>
        @endforeach
    </div>

</aside>

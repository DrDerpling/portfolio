@php
    /** @var \App\Modules\Frontend\DataObjects\NavigationLink[] $links */
@endphp

<aside class="bg-dark-navy text-cool-gray-500 py-4 pl-4 pr-6">
    @foreach($links as $link)
        <x-item :link="$link"/>
    @endforeach
</aside>

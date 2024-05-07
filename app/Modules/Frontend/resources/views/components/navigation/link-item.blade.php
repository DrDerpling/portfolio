@php
    /** @var \App\Modules\Frontend\DataObjects\NavigationLink $link */
    /** @var bool $hidden */

    $isActiveClass = $link->isActive() ? 'text-bright-cyan' : '';
    $hiddenClass = $hidden ? 'hidden' : '';
@endphp

<div>
    <a wire:navigate data-menu-item x-data="{
            addHistoryItem(item) {
                const visitedLinks = JSON.parse(localStorage.getItem('visitedLinks')) || [];
                const index = visitedLinks.findIndex((link) => link.title === item.title);

                // Splicing it so it can be added to the top of the list
                if (index !== -1) {
                    visitedLinks.splice(index, 1);
                }

                visitedLinks.push(item);

                localStorage.setItem('visitedLinks', JSON.stringify(visitedLinks));
                new Event('visitedLinksUpdated', { bubbles: true, composed: true });
            }
        }"
       x-on:click="addHistoryItem({'title': '{{ $link->getLabel() }}', 'link': '{{ $link->getUrl() }}'} )"
       class="flex items-center space-x-1 {{ $isActiveClass }} {{ $hiddenClass }}"
       href="{{ $link->getUrl() }}">
        <x-feather-icon name="{{ $link->getIconName() }}" className="h-4 w-4"/>
        <span>
            {{ $link->getLabel() }}
        </span>
    </a>
</div>


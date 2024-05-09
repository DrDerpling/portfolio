@php
 /** @var \App\Modules\Navigation\DataObjects\LinkItem[] $history */
@endphp

<div class="flex items-end flex-end h-16 min-h-16 bg-charcoal" >
    @foreach($history as $index => $link)
        <div class="px-2 py-1 border-t-2 border-t border-t-bright-cyan border-x border-x-slate">
            <a href="{{ $link->getUrl() }}" wire:navigate.hover class="text-white">{{ $link->getLabel() }}</a>
            <button wire:click="removeItem(@js($index))">x</button>
        </div>
    @endforeach
</div>

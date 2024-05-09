@php
    /** @var int $lineHeight */
    /** @var int $height */
@endphp

<div data-line-height="{{ $lineHeight }}"
     style="height: {{ $height }}vh; color: var(--code-line-color);"
     class="line-numbers text-right px-4 pt-4 flex flex-col absolute overflow-hidden max-h-full">
    <!-- Contains line number -->
</div>

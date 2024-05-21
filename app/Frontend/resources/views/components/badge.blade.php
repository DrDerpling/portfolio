@php
/** @var \Symfony\Component\HttpFoundation\Session\Attribute\AttributeBagInterface $attributes */

$baseClasses = [
    'bg-primary-lighter',
    'text-primary-lightest',
    'rounded-full',
    'px-3',
    'py-1',
    'text-sm',
    'font-semibold',
];

$attributeClasses = explode(' ', $attributes->get('class', ''));
$classes = array_merge($baseClasses, $attributeClasses);

@endphp

<span class="{{ implode(' ', $classes) }}">
    {{ $slot }}
</span>
@props([
    'src' => null,
    'alt' => '',
    'ratio' => 'aspect-[4/3]',
    'wrapperClass' => '',
    'imageClass' => '',
    'overlayClass' => 'bg-[linear-gradient(180deg,rgba(8,14,24,0.04),rgba(8,14,24,0.72))]',
    'rounded' => 'rounded-[1.8rem]',
    'lazy' => true,
    'skeleton' => true,
    'skeletonClass' => '',
    'objectFit' => 'object-cover',
])

<div class="relative overflow-hidden bg-slate-900 {{ $ratio }} {{ $rounded }} {{ $wrapperClass }}">
    @if ($skeleton)
        <div class="absolute inset-0 skeleton-shimmer {{ $skeletonClass }}"></div>
    @endif

    @if ($src)
        <img
            src="{{ $src }}"
            alt="{{ $alt }}"
            @if ($lazy) loading="lazy" decoding="async" @endif
            class="absolute inset-0 h-full w-full {{ $objectFit }} image-fade {{ $imageClass }}"
        >
    @else
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(121,196,255,0.24),transparent_40%),linear-gradient(180deg,rgba(10,18,34,0.95),rgba(5,9,19,1))]"></div>
    @endif

    @if ($overlayClass !== false)
        <div class="absolute inset-0 {{ $overlayClass }}"></div>
    @endif
</div>

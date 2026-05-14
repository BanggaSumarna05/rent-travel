@props([
    'items' => [],
    'badge' => null,
    'title' => '',
    'highlight' => null,
    'description' => null,
    'align' => 'center',
    'container' => 'wide',
    'glow' => 'right',
])

@php
    $isCentered = $align === 'center';
    $containerClass = $container === 'narrow' ? 'page-header-inner-narrow' : 'page-header-inner';
    $copyClass = $isCentered ? 'page-header-copy-centered' : 'page-header-copy';
    $descriptionClass = $isCentered ? 'page-description max-w-2xl mx-auto' : 'page-description max-w-2xl';
    $glowClass = match ($glow) {
        'left' => 'left-0 -ml-16 -mt-16',
        'center' => 'left-1/2 -translate-x-1/2 -mt-20',
        default => 'right-0 -mr-16 -mt-16',
    };
@endphp

<section class="page-header">
    <div class="absolute top-0 {{ $glowClass }} h-64 w-64 rounded-full bg-amber-50/70 blur-[90px] pointer-events-none"></div>

    <div class="{{ $containerClass }}">
        @if (! empty($items))
            <x-breadcrumb :items="$items" />
        @endif

        <div class="{{ $copyClass }}" data-aos="fade-down">
            @if ($badge)
                <div class="page-kicker mb-3 md:mb-5">
                    <span class="relative flex h-1.5 w-1.5 shrink-0">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-[#D4AF37]"></span>
                    </span>
                    <span>{{ $badge }}</span>
                </div>
            @endif

            <h1 class="page-title font-heading {{ $isCentered ? 'mx-auto max-w-4xl' : 'max-w-4xl' }}">
                {{ $title }}
                @if ($highlight)
                    <span class="gold-gradient-text">{{ $highlight }}</span>
                @endif
            </h1>

            @if ($description)
                <p class="{{ $descriptionClass }} mt-3 md:mt-5">
                    {{ $description }}
                </p>
            @endif
        </div>
    </div>
</section>

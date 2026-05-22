@props([
    'items' => [],
])

@if (filled($items))
    <div class="site-container pt-5 sm:pt-6 lg:pt-8">
        <nav aria-label="Breadcrumb" class="glass-panel-strong px-4 py-3 sm:px-6 sm:py-4">
            <ol class="flex flex-wrap items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-400 sm:text-[11px]">
                @foreach ($items as $item)
                    <li class="flex items-center gap-2">
                        @if (! $loop->first)
                            <svg viewBox="0 0 20 20" fill="none" aria-hidden="true" class="h-3.5 w-3.5 text-white/18">
                                <path d="M7.5 5.5L12 10l-4.5 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        @endif

                        @if (! empty($item['url']) && ! $loop->last)
                            <a href="{{ $item['url'] }}" class="transition duration-300 hover:text-white hover:opacity-100">
                                {{ $item['label'] }}
                            </a>
                        @else
                            <span aria-current="page" class="text-slate-100">{{ $item['label'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
@endif

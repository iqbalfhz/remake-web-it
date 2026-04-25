@if ($paginator->hasPages())
    <nav class="flex items-center gap-2" aria-label="Pagination">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span
                class="w-10 h-10 rounded-xl flex items-center justify-center bg-white/3 text-gray-600 cursor-not-allowed"
                style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                <i class="fa-solid fa-chevron-left text-xs"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="w-10 h-10 rounded-xl flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 transition-all"
                style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                <i class="fa-solid fa-chevron-left text-xs"></i>
            </a>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span
                    class="w-10 h-10 rounded-xl flex items-center justify-center text-gray-600 text-sm">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-semibold text-white"
                            style="background: linear-gradient(135deg, #2563eb, #06b6d4); box-shadow: 0 4px 15px rgba(37,99,235,0.35);">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                            class="w-10 h-10 rounded-xl flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 text-sm transition-all"
                            style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="w-10 h-10 rounded-xl flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 transition-all"
                style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                <i class="fa-solid fa-chevron-right text-xs"></i>
            </a>
        @else
            <span class="w-10 h-10 rounded-xl flex items-center justify-center text-gray-600 cursor-not-allowed"
                style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                <i class="fa-solid fa-chevron-right text-xs"></i>
            </span>
        @endif
    </nav>
@endif

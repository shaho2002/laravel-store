@php
    if (! isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet = ($scrollTo !== false)
        ? <<<JS
           (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
        JS
        : '';
@endphp

@if ($paginator->hasPages())
    <div class="flex items-center justify-center w-full mt-10">
        <ul
            class="flex items-center gap-x-3 child:flex child:items-center child:justify-center child:w-8 child:h-8 child:cursor-pointer child:shadow child:rounded-lg child:transition-all child:duration-300">

            {{-- دکمه صفحه قبل --}}
            <li
                class="bg-white dark:bg-gray-800 hover:bg-gray-800 dark:hover:bg-blue-500 hover:text-white {{ $paginator->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                @if ($paginator->onFirstPage())
                    <svg class="rotate-180 size-5">
                        <use href="#chevron-left"></use>
                    </svg>
                @else
                    <button type="button"
                            wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                    >
                        <svg class="rotate-180 size-5">
                            <use href="#chevron-left"></use>
                        </svg>
                    </button>
                @endif
            </li>

            {{-- المنت‌های پیجینیشن --}}
            @foreach ($elements as $element)
                {{-- نقطه‌چین‌ها --}}
                @if (is_string($element))
                    <li class="bg-white dark:bg-gray-800 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white">
                        <span>{{ $element }}</span>
                    </li>
                @endif

                {{-- لینک صفحات --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li
                            class="{{ $page == $paginator->currentPage()
                                ? 'text-white bg-blue-500'
                                : 'bg-white dark:bg-gray-800 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white' }}"
                            wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}"
                        >
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page">{{ $page }}</span>
                            @else
                                <button type="button"
                                        wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                        x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                                >
                                    {{ $page }}
                                </button>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- دکمه صفحه بعد --}}
            <li
                class="bg-white dark:bg-gray-800 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white {{ $paginator->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                @if ($paginator->hasMorePages())
                    <button type="button"
                            wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                    >
                        <svg class="size-5">
                            <use href="#chevron-left"></use>
                        </svg>
                    </button>
                @else
                    <svg class="size-5">
                        <use href="#chevron-left"></use>
                    </svg>
                @endif
            </li>
        </ul>
    </div>
@endif


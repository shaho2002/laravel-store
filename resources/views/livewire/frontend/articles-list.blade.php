<main class="container">
    <!-- Breadcrumb -->
    <nav class="flex mt-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="index.html"
                    class="inline-flex items-center text-sm text-gray-700 gap-x-1 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="size-4 mb-0.5">
                        <use href="#home" />
                    </svg>
                    صفحه اصلی
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="text-sm text-gray-500 ms-1 md:ms-2 dark:text-gray-400">مقالات</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="flex flex-col gap-4 mt-5 lg:flex-row">
        <!-- SIDE FILTER BOX -->
        <div
            class="flex-col items-center hidden py-4 bg-white rounded-lg shadow lg:sticky top-1 h-fit lg:w-1/4 lg:flex gap-y-4 dark:bg-gray-800">
            <!-- TITLE -->
            <div class="flex items-center justify-between w-full px-2 xl:px-4">
                <span class="flex items-center gap-x-1">
                    <p class="text-lg text-gray-700 font-DanaMedium dark:text-gray-200">فیلترها
                    </p>
                </span>
                <p class="text-sm text-blue-500 cursor-pointer dark:text-blue-400"> حذف فیلتر‌ها</p>
            </div>
            <!-- FILTERS -->
            <div class="w-full divide-y divide-slate-200 dark:divide-gray-700/20">
                <!-- Accordion -->
                <div class="">
                    <button onclick="toggleAccordion(1)"
                        class="flex items-center justify-between w-full px-2 pt-4 mb-4 text-gray-800 xl:px-4 dark:text-gray-100">
                        <span>دسته بندی </span>
                        <span id="icon-1" class="text-gray-800 dark:text-gray-100">
                            <svg class="transition-transform duration-300 size-4">
                                <use href="#chevron-left"></use>
                            </svg>
                        </span>
                    </button>
                    <div id="content-1" class="overflow-hidden transition-all duration-300 ease-in-out max-h-0">
                        <div class="pb-3 text-gray-700 dark:text-gray-300 w-full flex flex-col gap-y-1.5">
                            <!-- item -->
                            <div class="inline-flex items-center mr-2.5"
                                    wire:click="setCategory(null)">
                                    <label class="mr-1 text-gray-800 cursor-pointer dark:text-gray-400" for="ripple-2">
                                        همه
                                    </label>
                                </div>
                            @foreach ($this->categories as $category)
                                <div class="inline-flex items-center mr-2.5"
                                    wire:click="setCategory({{ $category->id }})">
                                    <label class="mr-1 text-gray-800 cursor-pointer dark:text-gray-400" for="ripple-2">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- TOGGLE SWITCH -->
                <div class="flex items-center justify-between w-full px-2 py-4 gap-x-3 xl:px-4" dir="ltr">
                    <label for="hs-valid-toggle-switch" class="relative inline-block h-6 cursor-pointer w-11">
                        <input type="checkbox" id="hs-valid-toggle-switch" class="sr-only peer">
                        <span
                            class="absolute inset-0 transition-colors duration-200 ease-in-out bg-gray-200 rounded-full peer-checked:bg-blue-500 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                        <span
                            class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                    </label>
                    <label for="hs-valid-toggle-switch" class="text-gray-800 dark:text-gray-100">
                        بروز‌ترین ها
                    </label>
                </div>
                <!-- TOGGLE SWITCH -->
                <div class="flex items-center justify-between w-full px-2 pt-4 gap-x-3 xl:px-4" dir="ltr">
                    <label for="hs-valid-toggle-switch3" class="relative inline-block h-6 cursor-pointer w-11">
                        <input type="checkbox" id="hs-valid-toggle-switch3" class="sr-only peer">
                        <span
                            class="absolute inset-0 transition-colors duration-200 ease-in-out bg-gray-200 rounded-full peer-checked:bg-blue-500 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                        <span
                            class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                    </label>
                    <label for="hs-valid-toggle-switch3"
                        class="flex items-center text-gray-800 dark:text-gray-100 gap-x-2">
                        اخبار
                    </label>
                </div>

            </div>
        </div>
        <!-- FILTER BOXES & articles -->
        <div class="lg:w-3/4">
            <div class="flex items-center lg:hidden gap-x-2">
                <!-- SORT BTN -->
                <button
                    class="sort-modal-open text-sm mb-4 py-1.5 px-3 app-border rounded-full flex items-center gap-x-1">
                    <svg class="text-gray-400 size-4">
                        <use href="#sort-list"></use>
                    </svg>
                    <p>مرتبط ترین</p>
                </button>
                <!-- SORT MODAL -->
                <div class="sort-modal">
                    <div class="flex justify-between sort-modal-close">
                        <p>مرتب سازی بر اساس </p>
                        <svg class="text-gray-800 size-5 dark:text-gray-300">
                            <use href="#x-mark"></use>
                        </svg>
                    </div>
                    <ul
                        class="flex flex-col items-center justify-center w-full divide-y divide-gray-300 child:w-full child:text-center dark:divide-gray-200/20 child:py-3">
                        <li>بروزترین</li>
                        <li>جدیدترین</li>
                        <li>گران‌ترین</li>
                        <li>
                            منتخب</li>
                        <li>پیشنهاد خریداران</li>
                    </ul>
                </div>
                <!-- FILTER BTN -->
                <button
                    class="filter-modal-open text-sm mb-4 py-1.5 px-3 app-border rounded-full flex items-center gap-x-1">
                    <svg class="text-gray-400 size-4">
                        <use href="#filter"></use>
                    </svg>
                    <p>فیلتر</p>
                </button>
                <!-- Filter MODAL -->
                <div class="filter-modal">
                    <div class="flex justify-between filter-modal-close">
                        <p>فیلتر</p>
                        <svg class="text-gray-800 size-5 dark:text-gray-300">
                            <use href="#x-mark"></use>
                        </svg>
                    </div>
                    <!-- FILTERS -->
                    <div class="w-full divide-y divide-slate-200 dark:divide-gray-700/20">
                        <!-- Accordion -->
                        <div class="">
                            <button onclick="toggleAccordion(1)"
                                class="flex items-center justify-between w-full px-2 pt-4 mb-4 text-gray-800 xl:px-4 dark:text-gray-100">
                                <span>دسته بندی </span>
                                <span id="icon-1" class="text-gray-800 dark:text-gray-100">
                                    <svg class="transition-transform duration-300 size-4">
                                        <use href="#chevron-left"></use>
                                    </svg>
                                </span>
                            </button>
                            <div id="content-1"
                                class="overflow-hidden transition-all duration-300 ease-in-out max-h-0">
                                <div class="pb-3 text-gray-700 dark:text-gray-300 w-full flex flex-col gap-y-1.5">
                                    @foreach ($this->categories as $category)
                                        <div class="inline-flex items-center mr-2.5">
                                            <label class="mr-1 text-gray-800 cursor-pointer dark:text-gray-400"
                                                wire:click="setCategory({{ $category->id }})" for="ripple-6">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- TOGGLE SWITCH -->
                        <div class="flex items-center justify-between w-full px-2 py-4 gap-x-3 xl:px-4"
                            dir="ltr">
                            <label for="hs-valid-toggle-switch" class="relative inline-block h-6 cursor-pointer w-11">
                                <input type="checkbox" id="hs-valid-toggle-switch" class="sr-only peer">
                                <span
                                    class="absolute inset-0 transition-colors duration-200 ease-in-out bg-gray-200 rounded-full peer-checked:bg-blue-500 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                                <span
                                    class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                            </label>
                            <label for="hs-valid-toggle-switch" class="text-gray-800 dark:text-gray-100">
                                بروز‌ترین ها
                            </label>
                        </div>
                        <!-- TOGGLE SWITCH -->
                        <div class="flex items-center justify-between w-full px-2 pt-4 gap-x-3 xl:px-4"
                            dir="ltr">
                            <label for="hs-valid-toggle-switch3"
                                class="relative inline-block h-6 cursor-pointer w-11">
                                <input type="checkbox" id="hs-valid-toggle-switch3" class="sr-only peer">
                                <span
                                    class="absolute inset-0 transition-colors duration-200 ease-in-out bg-gray-200 rounded-full peer-checked:bg-blue-500 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                                <span
                                    class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                            </label>
                            <label for="hs-valid-toggle-switch3"
                                class="flex items-center text-gray-800 dark:text-gray-100 gap-x-2">
                                اخبار
                            </label>
                        </div>

                    </div>
                </div>
                <span class="text-sm text-gray-400 ms-auto py-1.5 px-4">۱3,۰۴۰ مقاله </span>
            </div>
            <!-- TOP FILTER BOX -->
            <div class="items-center justify-between hidden mb-6 lg:flex">
                <div class="flex items-center gap-x-5">
                    <div class="flex items-center gap-x-2">
                        <svg class="text-gray-400 size-6">
                            <use href="#sort-list"></use>
                        </svg>
                        <h2 class="text-gray-400 font-DanaDemiBold">مرتب سازی :</h2>
                    </div>
                    <ul
                        class="flex items-center gap-x-1 lg:gap-x-4 child:transition-all child:cursor-pointer child:rounded-lg child:px-1 child:py-1 child:text-sm child:lg:text-base">

                        <li wire:click="orderBy('newest')"
                            class="{{ $this->order === 'newest' ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                            جدید‌ترین
                        </li>

                        <li wire:click="orderBy('mostView')"
                            class="{{ $this->order === 'mostView' ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                            پربازدیدترین
                        </li>

                        <li wire:click="orderBy('oldest')"
                            class="{{ $this->order === 'oldest' ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                            قدیمی‌ترین
                        </li>

                    </ul>
                </div>
                <span class="text-sm text-gray-400 end">{{ $articles->count() }} مقاله </span>
            </div>
            <!-- articles -->
            <div class="grid grid-cols-1 gap-6 xxs:grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 xl:grid-cols-3">

                <!-- ITEM -->
                @foreach ($articles as $article)
                    <div class="group article-box">
                        <div class="relative overflow-hidden rounded-lg">
                            <img src="{{ asset('images/articles/' . $article->image) }}" class="article-box_img"
                                alt="{{ $article->title }}" />
                            <div
                                class="absolute top-0 bottom-0 left-0 right-0 flex items-center justify-center transition-all duration-300 opacity-0 bg-black/60 group-hover:opacity-100 rounded-bl-3xl rounded-tr-3xl">
                                <a href="{{ route('article', $article->slug) }}"
                                    class="flex items-center px-2 py-1 text-white border-2 border-white rounded-lg gap-x-1 font-DanaMedium">
                                    <p>ادامه مطالب</p>
                                    <svg class="w-4 h-4 rotate-90">
                                        <use href="#chevron"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-col px-1 py-5 gap-y-1">
                            <h2 class="font-DanaDemiBold">{{ $article->title }}</h2>
                        </div>
                        <span class="flex w-full h-1 py-1 border-t border-gray-100 dark:border-white/10"></span>
                        <div class="flex items-center justify-between px-1 text-sm">
                            <span class="flex items-center text-blue-500 gap-x-1 dark:text-sky-400">
                                <svg class="w-4 h-4">
                                    <use href="#calendar"></use>
                                </svg>
                                <p class="mt-1">
                                    {{ Hekmatinasser\Verta\Verta::instance($article->created_at)->formatJalaliDate() }}
                                </p>
                            </span>
                            <span class="flex items-start text-gray-300 gap-x-1">
                                <p class="font-DanaDemiBold">120</p>
                                <svg class="w-4 h-4">
                                    <use href="#eye"></use>
                                </svg>
                            </span>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- PAGINATION -->
            {{ $articles->links('frontend.layouts.front_pagination') }}

        </div>
    </div>
</main>

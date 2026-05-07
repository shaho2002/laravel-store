<div class="hidden w-full tab-content tab3" wire:ignore.self>
    <div class="flex items-center mb-6 gap-x-2">
        <h2 class="text-2xl font-DanaMedium ">
            دیدگاه ها
        </h2>
        <p class="text-sm text-blue-500">
            ({{ $comments->count() + $moreComments->count() }})
        </p>
    </div>
    <div class="flex flex-col items-start w-full gap-10 md:flex-row">
        <!-- SUBMIT COMMENT -->

        <div class="flex flex-col w-full lg:w-1/4 ">
            <p class="mb-2 text-lg font-DanaMedium">ثبت دیدگاه</p>
            @guest
                <p class="mb-4 text-sm">برای ثبت نظر ابتدا
                    <a href="{{ route('login') }}" class="text-blue-600 underline hover:text-blue-800">
                        وارد
                    </a>
                    شوید
                </p>
            @endguest

            <input type="text" placeholder="عنوان" class="tailwind-input" wire:model="title">
            @error('title')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
            <textarea class="h-24 tailwind-input" placeholder="متن دیدگاه" wire:model="comment"></textarea>
            @error('comment')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
            <p class="mb-4 text-sm text-gray-500 dark:text-white">این محصول را به دیگران پیشنهاد : </p>
            <div
                class="grid grid-cols-12 gap-4 mb-5 child:col-span-6 child:w-full child:flex child:items-center child:justify-center child:gap-x-2 child:rounded-lg child:shadow child:py-2 child:font-DanaMedium child:duration-300 child:transition-all">
                <button wire:click="recommend"
                    class="text-green-600 ring-transparent ring-1 focus:ring-green-600 dark:ring-white/20 dark:focus:ring-green-600">
                    <svg class="w-5 h-5">
                        <use href="#hand-up"></use>
                    </svg>
                    میکنم
                </button>
                <button wire:click="notRecommend"
                    class="text-red-500 ring-transparent ring-1 focus:ring-[#EF4343] dark:ring-white/20 dark:focus:ring-[#EF4343]">
                    <svg class="w-5 h-5">
                        <use href="#hand-down"></use>
                    </svg>
                    نمیکنم
                </button>
            </div>
                @auth
                    <button class="p-2 text-white transition-all bg-blue-500 rounded-lg hover:bg-blue-600"
                wire:click="submitComment">ثبت </button>
                @else
                    <a class="p-2 text-center text-white transition-all bg-blue-500 rounded-lg hover:bg-blue-600"
                href="{{ route('login') }}">وارد شوید </a>
                @endauth
           
        </div>

        <!-- ALL COMMENTS -->
        <ul class="flex flex-col lg:w-3/4 gap-y-2 child:w-full ">
            <!-- COMMENT ITEMS -->
            @if ($comments->count() > 0)
                @foreach ($comments as $comment)
                    <li class="py-4 border-b border-gray-200 child:flex dark:border-b-gray-200/20 child:border-white/20"
                        id="comments-list">
                        <!-- TITLE -->
                        <div class="flex items-center gap-x-2">
                            <h2 class="mb-1 text-lg font-DanaMedium">{{ $comment->title }}</h2>
                            @if ($comment->recommendation !== null)
                                <span class="px-2 py-1 mb-2 text-xs text-white bg-blue-500 rounded-lg">خریدار</span>
                            @endif
                        </div>
                        <!-- COOMENT TEXT -->

                        <div class="flex-col">
                            @if ($comment->recommendation === 1)
                                <h2 class="flex items-center mb-4 text-green-500 gap-x-1">
                                    <svg class="w-4 h-4">
                                        <use href="#hand-up"></use>
                                    </svg>
                                    پیشنهاد میشود
                                </h2>
                            @elseif($comment->recommendation === 0)
                                <h2 class="flex items-center mb-4 text-red-500 gap-x-1">
                                    <svg class="w-4 h-4">
                                        <use href="#hand-down"></use>
                                    </svg>
                                    پیشنهاد نمیشود
                                </h2>
                            @endif

                            <p class="mb-2 text-gray-500 dark:text-gray-200 line-clamp-2">
                                {{ $comment->comment }}
                            </p>
                        </div>
                        <!-- COMMENT FOOTER -->
                        <div class="flex-col justify-between mt-2 lg:mt-0 lg:flex-row gap-y-2 lg:items-center">
                            <div class="flex items-center text-sm text-gray-400 gap-x-4">
                                <p>{{ Hekmatinasser\Verta\Verta::instance($comment->created_at)->format('d F Y') }}</p>
                                <p>{{ $comment->user->name }}</p>
                            </div>
                            <div class="flex flex-wrap items-center mt-2 gap-x-2">
                                <p class="text-sm text-gray-400">آیا این دیدگاه برایتان مفید بود؟</p>
                                <div
                                    class="flex items-center gap-x-2 child:flex child:items-center child:gap-x-1 child:rounded-lg child:p-2 child:font-DanaMedium child:duration-300 child:transition-all child:text-sm">
                                    <button
                                        class="text-green-600 ring-transparent ring-1 focus:ring-green-600 dark:focus:ring-green-600">
                                        78
                                        <svg class="w-4 h-4">
                                            <use href="#hand-up"></use>
                                        </svg>
                                    </button>
                                    <button
                                        class="text-red-500 ring-transparent ring-1 focus:ring-[#EF4343]  dark:focus:ring-[#EF4343]">
                                        25
                                        <svg class="w-4 h-4">
                                            <use href="#hand-down"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            @else
                <div class="flex justify-center items-center min-h-[500px] w-full">
                    <div class="p-5 pt-8 text-base text-center text-gray-500 rounded-lg">
                        هنوز هیچ کامنتی ثبت نشده است.
                    </div>
                </div>
            @endif

            <!-- HIDDEN COMMENTS -->

            <!-- COMMENT ITEMS -->
            @if ($moreComments->count() > 0)
                @foreach ($moreComments as $moreComment)
                    <li
                        class="hidden py-4 border-b border-gray-200 hidden-comment-item child:flex dark:border-b-gray-200/20 child:border-white/20">
                        <!-- TITLE -->
                        <div class="flex items-center gap-x-2">
                            <h2 class="mb-1 text-lg font-DanaMedium"> {{ $moreComment->title }}</h2>
                            @if ($moreComment->recommendation !== null)
                                <span class="px-2 py-1 mb-2 text-xs text-white bg-blue-500 rounded-lg">خریدار</span>
                            @endif
                        </div>
                        <!-- COOMENT TEXT -->
                        <div class="flex-col">
                            @if ($moreComment->recommendation === 1)
                                <h2 class="flex items-center mb-4 text-green-500 gap-x-1">
                                    <svg class="w-4 h-4">
                                        <use href="#hand-up"></use>
                                    </svg>
                                    پیشنهاد میشود
                                </h2>
                            @elseif($moreComment->recommendation === 0)
                                <h2 class="flex items-center mb-4 text-red-500 gap-x-1">
                                    <svg class="w-4 h-4">
                                        <use href="#hand-down"></use>
                                    </svg>
                                    پیشنهاد نمیشود
                                </h2>
                            @endif
                            <p class="mb-2 text-gray-500 dark:text-gray-200">
                                {{ $moreComment->comment }}
                            </p>
                        </div>
                        <!-- COMMENT FOOTER -->
                        <div class="flex-col justify-between mt-2 lg:mt-0 lg:flex-row gap-y-2 lg:items-center">
                            <div class="flex items-center text-sm text-gray-400 gap-x-4">
                                <p>{{ Hekmatinasser\Verta\Verta::instance($moreComment->created_at)->format('d F Y') }}
                                </p>
                                <p>{{ $moreComment->user->name }}</p>
                            </div>
                            <div class="flex flex-wrap items-center mt-2 gap-x-2">
                                <p class="text-sm text-gray-400">آیا این دیدگاه برایتان مفید بود؟</p>
                                <div
                                    class="flex items-center gap-x-2 child:flex child:items-center child:gap-x-1 child:rounded-lg child:p-2 child:font-DanaMedium child:duration-300 child:transition-all child:text-sm">
                                    <button
                                        class="text-green-600 ring-transparent ring-1 focus:ring-green-600 dark:focus:ring-green-600">
                                        4
                                        <svg class="w-4 h-4">
                                            <use href="#hand-up"></use>
                                        </svg>
                                    </button>
                                    <button
                                        class="text-red-500 ring-transparent ring-1 focus:ring-[#EF4343]  dark:focus:ring-[#EF4343]">
                                        15
                                        <svg class="w-4 h-4">
                                            <use href="#hand-down"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach

                <button
                    class="flex items-center justify-center w-full my-4 text-blue-600 more-comment-btn gap-x-1 dark:text-blue-400 font-DanaMedium">
                    <p class="more-comment-text">مشاهده بیشتر</p>
                    <svg class="size-4 more-comment-icon">
                        <use href="#chevron"></use>
                    </svg>
                </button>
            @endif

        </ul>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const shouldScroll = @json(session('scrollToComments'));

        if (shouldScroll) {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
        }
    });
</script>

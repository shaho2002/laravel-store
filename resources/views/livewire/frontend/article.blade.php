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
            <li class="inline-flex items-center">
                <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <a href="shop.html"
                    class="inline-flex items-center text-sm text-gray-700 gap-x-1 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    مقالات
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="text-sm text-gray-500 ms-1 md:ms-2 dark:text-gray-400">جزییات مقاله</span>
                </div>
            </li>
        </ol>
    </nav>
    <!-- Article Details -->
    <section class="flex flex-col items-start gap-4 mt-8 lg:flex-row ">
        <!-- ARTICLE -->
        <div
            class="flex flex-col w-full px-4 py-4 bg-white rounded-lg shadow lg:w-3/4 gap-y-8 lg:px-8 dark:bg-gray-800">
            <!-- ARTICLE HEADER -->
            <div class="flex flex-col w-full gap-y-6 ">
                <div class="flex flex-col lg:flex-row gap-y-3 lg:items-center lg:justify-between">
                    <h2 class="text-lg font-DanaDemiBold lg:text-2xl">{{ $this->article->title }}</h2>
                    <span class="flex items-center text-blue-500 cursor-pointer gap-x-1">
                        <svg class="w-4 h-4">
                            <use href="#share"></use>
                        </svg>
                        <p class="font-DanaMedium">اشتراک گذاری</p>
                    </span>
                </div>
                <div class="flex flex-wrap items-center text-sm gap-y-3 gap-x-8">
                    <span class="flex items-center text-gray-400 gap-x-1 ">
                        <svg class="w-4 h-4">
                            <use href="#list-bullet"></use>
                        </svg>
                        <p>دسته‌بندی :{{ $this->article->articleCategory->name }}</p>
                    </span>
                    <span class="flex items-center text-gray-400 gap-x-1 ">
                        <svg class="w-4 h-4">
                            <use href="#user"></use>
                        </svg>
                        <p>توسط :{{ $this->article->user->name }}</p>
                    </span>
                    <span class="flex items-center text-gray-400 gap-x-1 ">
                        <svg class="w-4 h-4">
                            <use href="#calendar"></use>
                        </svg>
                        <p> تاریخ انتشار : {{ Hekmatinasser\Verta\Verta::instance($this->article->created_at)->formatJalaliDate() }} </p>
                    </span>
                </div>
            </div>
            <!-- ARTICLE MAIN -->
            <div>
                <img class="rounded-lg" src="{{ asset('Images/articles/' . $this->article->image) }}" alt="{{ $this->article->title }}">
                <p class="mt-3 leading-10 text-gray-600 dark:text-gray-300">
                    {{ $this->article->article }}
                </p>
            </div>
        </div>
        <!-- SIDE BAR -->
        <div
            class="w-full space-y-5 top-2 lg:sticky lg:w-1/4 child:rounded-lg child:bg-white child:dark:bg-gray-800 child:shadow child:p-4 child:flex child:flex-col child:gap-y-4">
            <div>
                <h4 class="font-DanaMedium">جدیدترین مقالات : </h4>
                <ul class="w-full space-y-4 child:flex child:items-center child:gap-x-2 child:cursor-pointer ">
                    
                    @foreach ($this->newestArticles as $newestArticle )
                    
                        <li>
                        <img class="object-cover w-24 h-16 rounded-lg" src="{{ asset('Images/articles/' . $newestArticle->image) }}" alt="">
                        <a class="flex flex-col gap-y-2 " href="{{ route('article',$newestArticle->slug) }}">
                            <p class="line-clamp-1">{{ $newestArticle->title }}</p>
                            <span href="{{ route('article',$newestArticle->slug) }}" class="flex items-center text-sm text-gray-400 gap-x-1">
                                <svg class="w-4 h-4 mb-1">
                                    <use href="#calendar"></use>
                                </svg>
                                {{ Hekmatinasser\Verta\Verta::instance($newestArticle->created_at)->formatJalaliDate() }}
                            </span>
                        </a>
                    </li>
                    @endforeach

                </ul>
                <a href="{{ route('articles.list') }}"
                    class="py-1.5 gap-x-1 bg-blue-500 hover:bg-blue-600 flex items-center justify-center text-white rounded-lg transition-all">مشاهده
                    بیشتر
                    <svg class="w-4 h-4">
                        <use href="#chevron-left"></use>
                    </svg>
                </a>
            </div>
            <div>
                <h4 class="font-DanaMedium"> دسته بندی : </h4>
                <ul class="space-y-3 child:flex child:items-center child:justify-between child:cursor-pointer ">
                    @foreach ($this->articleCategories as $articleCategory )
                        <li class="group">
                            <span
                                class="flex items-center justify-center transition-all duration-300 gap-x-1 group-hover:pr-2 group-hover:text-blue-500">
                                <p>{{ $articleCategory->name }}</p>
                                <svg class="w-4 h-4">
                                    <use href="#chevron-left"></use>
                                </svg>
                            </span>
                            <span
                                class="flex items-center justify-center w-5 h-5 text-xs text-white bg-blue-500 rounded-lg">{{ App\Models\Article::query()->where('article_category_id', $articleCategory->id)->count() }}</span>
                        </li>
                    @endforeach
                    

                </ul>
            </div>
        </div>

    </section>

</main>

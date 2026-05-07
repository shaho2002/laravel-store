{{-- show comments --}}
<div class="panel">
    <div class="flex items-center justify-between mb-5">
        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
            <h5 class="text-lg font-semibold dark:text-white-light">دیدگاه و نظرات</h5>
            {{-- include loading --}}
            @include('admin.layouts.loading')
            {{-- Search Box --}}
            <div class="sm:ltr:mr-auto sm:rtl:ml-auto" x-data="{ search: false }" @click.outside="search = false">
                <form wire:submit.prevent="search"
                    class="relative hidden mx-4 -translate-y-1/2 top-1/2 sm:relative sm:top-0 sm:block sm:translate-y-0"
                    :class="{ '!block': search }" @submit.prevent="search = false">
                    <input type="text" wire:model="searchedData"
                        class="bg-gray-100 peer form-input placeholder:tracking-widest ltr:pl-9 ltr:pr-9 rtl:pr-9 rtl:pl-9 sm:bg-transparent ltr:sm:pr-4 rtl:sm:pl-4"
                        placeholder="جستجو" />
                    <button type="submit" class="absolute inset-0 appearance-none h-9 w-9 peer-focus:text-primary">
                        <svg class="mx-auto" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5"
                                opacity="0.5" />
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                        </svg>
                    </button>
                </form>
                <button type="button"
                    class="p-2 rounded-full search_btn bg-white-light/40 hover:bg-white-light/90 dark:bg-dark/40 dark:hover:bg-dark/60 sm:hidden"
                    @click="search = ! search">
                    <svg class="mx-auto h-4.5 w-4.5 dark:text-[#d0d2d6]" width="20" height="20"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5"
                            opacity="0.5" />
                        <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @if ($comments->isEmpty())
        <hr class="mb-4">
        <div class="mt-5 text-center text-gray-500">موردی یافت نشد</div>
    @else
        <div class="mb-5">
            <div class="mt-3 table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کاربر</th>
                            <th>عنوان </th>
                            <th>پست مربوطه</th>
                            <th>متن کامنت</th>
                            <th>تاریخ</th>
                            <th>وضعیت انتشار</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $index => $comment)
                            <tr>
                                <td>{{ $comments->firstItem() + $index }}</td>
                                <td>{{ $comment->user->name }}</td>

                                @if ($comment->recommendation === 0)
                                    <td class="text-danger">{{ $comment->title }}</td>
                                @elseif($comment->recommendation === 1)
                                    <td class=" text-success">{{ $comment->title }}</td>
                                @elseif($comment->recommendation === null)
                                    <td>{{ $comment->title }}</td>
                                @endif
                                <td><a class="text-primary"
                                        href="{{ route('product.details', $comment->product->slug) }}">
                                        {{ $comment->product->name }} </a></td>
                                <td>
                                    <button type="button" @click="$tooltip('{{ $comment->comment }}')" class="badge badge-outline-dark">متن کامل</button>
                                    {{ Str::limit( $comment->comment, 20, '...') }}</td>
                                @if (Hekmatinasser\Verta\Verta::instance($comment->created_at)->diffDays() > 0)
                                    <td>{{ Hekmatinasser\Verta\Verta::instance($comment->created_at)->diffDays() }}
                                        روز قبل
                                    </td>
                                @elseif(Hekmatinasser\Verta\Verta::instance($comment->created_at)->diffDays() <= 0)
                                    @if (Hekmatinasser\Verta\Verta::instance($comment->created_at)->diffHours() > 0)
                                        <td>{{ Hekmatinasser\Verta\Verta::instance($comment->created_at)->diffHours() }}
                                            ساعت قبل
                                        </td>
                                    @else
                                        <td>اخیرا</td>
                                    @endif
                                @endif
                                <td>
                                    @if ($comment->status == 'active')
                                        <button type="button" wire:click="change_status({{ $comment->id }})"
                                            class="btn btn-success btn-sm">منتشر شده</button>
                                    @elseif($comment->status == 'notActive')
                                        <button type="button" wire:click="change_status({{ $comment->id }})"
                                            class="btn btn-danger btn-sm">منتشر نشده</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- pagination --}}
                <div class="panel">
                    <div class="flex flex-col justify-center w-full">
                        {{ $comments->links('admin.layouts.admin_pagination') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

</div>
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("modal", (initialOpenState = false) => ({
            open: initialOpenState,

            toggle() {
                this.open = !this.open;
            },
        }));
    });

    document.addEventListener('livewire:init', () => {
        Livewire.on('sweetAlert', (data) => {
            const alertMessage = data['message']
            const alertType = data['type']
            showAlert(alertMessage, alertType);
        });

        Livewire.on('deleteConfirm', (event) => {
            const user_id = event.user_id;
            destroyUser(user_id);
        });
    });
</script>

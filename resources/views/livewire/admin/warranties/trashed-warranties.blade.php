<div class="grid grid-cols-1 gap-6 p-3 ">
    {{-- show trashed warranties --}}
    <div class="panel">
        {{-- include loading --}}
        @include('admin.layouts.loading')
        <div class="flex items-center justify-between mb-5">
            <div class="grid grid-cols-1 gap-5 ">
                <h5 class="text-lg font-semibold dark:text-white-light">لیست گارانتی‌های حذف شده</h5>
            </div>
            {{-- search box --}}
            <div class="sm:ltr:mr-auto sm:rtl:ml-auto" x-data="{ search: false }" @click.outside="search = false">
                <form wire:submit.prevent="search"
                    class="absolute inset-x-0 z-10 hidden mx-4 -translate-y-1/2 top-1/2 sm:relative sm:top-0 sm:mx-0 sm:block sm:translate-y-0"
                    :class="{ '!block': search }" @submit.prevent="search = false">
                    <div class="relative">
                        <input type="text" wire:model="searchedData"
                            class="bg-gray-100 peer form-input placeholder:tracking-widest ltr:pl-9 ltr:pr-9 rtl:pr-9 rtl:pl-9 sm:bg-transparent ltr:sm:pr-4 rtl:sm:pl-4"
                            placeholder="جستجو" />
                        <button type="submit" wire:model="searchedData"
                            class="absolute inset-0 appearance-none h-9 w-9 peer-focus:text-primary ltr:right-auto rtl:left-auto">
                            <svg class="mx-auto" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5"
                                    opacity="0.5" />
                                <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                        </button>
                        <button type="submit"
                            class="absolute block -translate-y-1/2 top-1/2 hover:opacity-80 ltr:right-2 rtl:left-2 sm:hidden">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="1.5" />
                                <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>
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
            <a href="{{ route('admin.warranties.list') }}" type="button" class="btn btn-info">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                گارانتی‌ها
            </a>
        </div>

        @if ($warranties->isEmpty())
            <hr class="mb-4">
            <div class="mt-5 text-center text-gray-500">موردی یافت نشد</div>
        @else
            <div class="mb-5">
                <div class="mt-3 table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام گارانتی</th>
                                <th>کد گارانتی</th>
                                <th>توضیحات</th>
                                <th>عکس</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warranties as $index => $warranty)
                                <tr>
                                    <td>{{ $warranties->firstItem() + $index }}</td>
                                    <td>{{ $warranty->name }}</td>
                                    <td>{{ $warranty->code }}</td>
                                    <td>{{ Str::limit($warranty->description, 50) }}</td>
                                    <td>
                                        @if ($warranty->image)
                                            <img src="{{ asset('images/warranties/' . $warranty->image) }}"
                                                alt="{{ $warranty->name }}"
                                                class="object-contain w-16 h-16 mx-auto rounded-md">
                                        @else
                                            <img src="{{ asset('images/noImage/noImage.png') }}"
                                                alt="{{ $warranty->name }}"
                                                class="object-contain w-16 h-16 mx-auto rounded-md">
                                        @endif
                                    </td>
                                    <td class="border-b border-[#ebedf2] p-3 text-center dark:border-[#191e3a]">
                                        <button type="button" x-tooltip="Restore"
                                            wire:click="$dispatch('confirmRestore',{ warranty_id : {{ $warranty->id }} })">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4.5 w-4.5 ltr:mr-2 rtl:ml-2">
                                                <path
                                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"
                                                    stroke="currentColor" stroke-width="1.5"></path>
                                            </svg>
                                        </button>
                                        <button type="button" x-tooltip="Delete"
                                            wire:click="$dispatch('deleteConfirm',{ warranty_id : {{ $warranty->id }} })">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                                <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round"></path>
                                                <path
                                                    d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                                </path>
                                                <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round"></path>
                                                <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- pagination --}}
                    <div class="panel">
                        <div class="flex flex-col justify-center w-full">
                            {{ $warranties->links('admin.layouts.admin_pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('sweetAlert', (data) => {
            const alertMessage = data['message']
            const alertType = data['type']
            showAlert(alertMessage, alertType);
        });

        Livewire.on('deleteConfirm', (event) => {
            const warranty_id = event.warranty_id;
            hardDeleteWarranty(warranty_id);
        });

        Livewire.on('confirmRestore', (event) => {
            const warranty_id = event.warranty_id;
            restoreWarranty(warranty_id);
        });
    });
</script>
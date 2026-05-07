<div class="grid grid-cols-1 gap-6 p-3 ">
    {{-- Add users --}}
    <div class="panel">
        {{-- include loading --}}
        @include('admin.layouts.loading')
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">
                {{ $this->userIndex ? 'ویرایش کاربر' : 'افزودن کاربر جدید' }}</h5>
        </div>
        <div class="mb-5">
            <form class="space-y-5">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div class="">
                        <label for="customFname">نام و نام‌خانوادگی</label>
                        <input wire:model="name" id="customFname" type="text"
                            placeholder="نام و نام خانوادگی کاربر را وارد کنید" class="form-input">
                        <p class="mt-1 text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="">
                        <label for="mobile">شماره</label>
                        <input wire:model="mobile" id="mobile" type="tel" placeholder="شماره کاربر را وارد کنید"
                            class="form-input">
                        <p class="mt-1 text-danger">
                            @error('mobile')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="">
                        <label for="customeEmail"> ایمیل</label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center border border-[#e0e6ed] bg-[#eee] px-3 font-semibold ltr:rounded-l-md ltr:border-r-0 rtl:rounded-r-md rtl:border-l-0 dark:border-[#17263c] dark:bg-[#1b2e4b]">
                                @
                            </div>
                            <input wire:model="email" id="Email" type="Email"
                                placeholder=" ایمیل کاربر را وارد کنید"
                                class="form-input ltr:rounded-l-none rtl:rounded-r-none">
                        </div>
                        <p class="mt-1 text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="">
                        <label for="password">رمز عبور</label>
                        <div class="flex">
                            <input wire:model="password" id="password" type="password"
                                placeholder="رمز عبور کاربر را وارد کنید"
                                class="form-input ltr:rounded-l-none rtl:rounded-r-none">
                        </div>
                        <p class="mt-1 text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </p>

                    </div>
                </div>

                @if ($this->userIndex)
                    <div class="flex gap-4">
                        <button type="button" wire:click="updateUser" class="btn btn-success !mt-6">ویرایش
                            کاربر</button>
                        <button type="button" wire:click="editCancel" class="btn btn-danger !mt-6">لغو</button>
                    </div>
                @else
                    <button type="button" wire:click="createUser" class="btn btn-primary !mt-6">ثبت کاربر</button>
                @endif

            </form>
        </div>
    </div>
    {{-- show users --}}
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <h5 class="text-lg font-semibold dark:text-white-light">لیست کاربران</h5>

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
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
            </div>
            <a href="{{ route('admin.trashed.users') }}" type="button" class="btn btn-danger">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ltr:mr-1.5 rtl:ml-1.5">
                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"></circle>
                    <path opacity="0.5"
                        d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 "
                        stroke="currentColor" stroke-width="1.5"></path>
                </svg>
                حذف شده‌ها
            </a>
        </div>

        @if ($users->isEmpty())
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
                                <th>ایمیل</th>
                                <th>نقش</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $users->firstItem() + $index }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td x-data="modal">

                                        <div class="flex items-center justify-center">
                                            <button type="button" class="btn btn-info"
                                                wire:click="selectedUser({{ $user->id }})" @click="toggle">
                                                نقش‌های کاربر</button>
                                        </div>

                                        <!-- modal -->
                                        <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto"
                                            :class="open && '!block'">
                                            <div class="flex items-center justify-center min-h-screen px-4"
                                                @click.self="open = false">
                                                <div x-show="open" x-transition x-transition.duration.300
                                                    class="w-full max-w-lg p-0 my-8 overflow-hidden border-0 rounded-lg panel">
                                                    <div
                                                        class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                                        <h5 class="text-lg font-bold"> افزودن نقش به کاربر</h5>
                                                        <button type="button" class="text-white-dark hover:text-dark"
                                                            @click="toggle">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                height="24px" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="w-6 h-6">
                                                                <line x1="18" y1="6" x2="6"
                                                                    y2="18"></line>
                                                                <line x1="6" y1="6" x2="18"
                                                                    y2="18"></line>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="p-5">
                                                        <div
                                                            class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                                                            {{-- loading permission --}}
                                                            <div wire:loading class="text-center">
                                                                <span
                                                                    class="inline-block w-10 h-10 m-auto mb-10 align-middle border-4 rounded-full animate-spin border-primary border-l-transparent"></span>
                                                                <p class="text-sm text-gray-500">
                                                                    لطفاً چند لحظه صبر کنید ...
                                                                </p>
                                                            </div>

                                                            <div class="flex flex-col gap-3" wire:loading.remove>
                                                                @foreach ($roles as $role)
                                                                    <label class="flex items-center gap-3">
                                                                        <input type="checkbox"
                                                                            value="{{ $role->name }}"
                                                                            wire:model="selected_roles"
                                                                            class="form-checkbox outline-success">
                                                                        <span class="leading-none">
                                                                            {{ $role->name }}
                                                                        </span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        <div class="flex items-center justify-end mt-8">
                                                            <button type="button" class="btn btn-outline-danger"
                                                                @click="toggle">لغو</button>
                                                            <button type="button"
                                                                class="btn btn-primary ltr:ml-4 rtl:mr-4"
                                                                @click="toggle"
                                                                wire:click="save_user_roles">ثبت</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-b border-[#ebedf2] p-3 text-center dark:border-[#191e3a]">
                                        <button type="button" x-tooltip="ویرایش"
                                            wire:click="editUser({{ $user->id }})" @click="scrollToTop()">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4.5 w-4.5 ltr:mr-2 rtl:ml-2">
                                                <path
                                                    d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z"
                                                    stroke="currentColor" stroke-width="1.5"></path>
                                                <path opacity="0.5"
                                                    d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015"
                                                    stroke="currentColor" stroke-width="1.5"></path>
                                            </svg>
                                        </button>
                                        <button type="button" x-tooltip="حذف"
                                            wire:click="$dispatch('deleteConfirm', { user_id: {{ $user->id }} })">
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
                                                <path opacity="0.5"
                                                    d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                                    stroke="currentColor" stroke-width="1.5"></path>
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
                            {{ $users->links('admin.layouts.admin_pagination') }}
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



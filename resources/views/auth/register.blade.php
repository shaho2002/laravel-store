@extends('auth.core.master')
@section('content')
<div class="min-h-screen text-black main-container dark:text-white-dark">
            <div class="flex min-h-screen items-center justify-center bg-[url('../images/map.svg')] bg-cover bg-center dark:bg-[url('../images/map-dark.svg')]">
                <div class="panel m-6 w-full max-w-lg sm:w-[480px]">
                    <h2 class="mb-3 text-2xl font-bold">ثبت نام</h2>
                    <p class="mb-7">برای ثبت نام ایمیل و رمز عبور خود را وارد کنید</p>
                    <form class="space-y-5" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div>
                            <label for="name">نام</label>
                            <input id="name" type="text" class="form-input" placeholder="نام را وارد کنید" name="name" value="{{ old('name') }}" required/>
                        </div>
                        @error('name')
                            <p class="mt-1 text-danger">{{ $message }}</p>
                        @enderror
                        <div>
                            <label for="email">ایمیل</label>
                            <input id="email" type="email" class="form-input" placeholder="ایمیل را وارد کنید" name="email" value="{{ old('email') }}" required/>
                        </div>
                        @error('email')
                            <p class="mt-1 text-danger">{{ $message }}</p>
                        @enderror
                        <div>
                            <label for="password">رمزعبور</label>
                            <input id="password" type="password" class="form-input" placeholder="رمزعبور را وارد کنید" name="password"  required/>
                        </div>
                        @error('password')
                            <p class="mt-1 text-danger">{{ $message }}</p>
                        @enderror
                        <div>
                            <label for="password">تکرار رمزعبور</label>
                            <input id="password" type="password" class="form-input" placeholder="رمزعبور را مجددا وارد کنید"name="password_confirmation"  required/>
                        </div>
                        @error('password_confirmation')
                            <p class="mt-1 text-danger">{{ $message }}</p>
                        @enderror
                        <div>
                            <label class="cursor-pointer">
                                <input type="checkbox" class="form-checkbox" required/>
                                <span for="custom_checkbox" class="text-white-dark"
                                    >موافقم با <a href="javascript:;" class="text-primary hover:underline">شرایط و ضوابط</a></span
                                >
                            </label>
                        </div>
                        <button type="submit" class="w-full btn btn-primary">ثبت نام</button>
                    </form>

                    <p class="mt-4 text-center">
                        از قبل حساب کاربری دارید؟ <a href="{{ route('login') }}" class="font-bold text-primary hover:underline">ورود</a>
                    </p>
                </div>
            </div>
        </div>
@endsection
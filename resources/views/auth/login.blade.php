@extends('auth.core.master')
@section('content')
<div class="min-h-screen text-black main-container dark:text-white-dark">
        <!-- start main content section -->
        <div
            class="flex min-h-screen items-center justify-center bg-[url('../images/map.svg')] bg-cover bg-center dark:bg-[url('../images/map-dark.svg')]">
            <div class="panel m-6 w-full max-w-lg sm:w-[480px]">
                <h2 class="mb-3 text-2xl font-bold">ورود</h2>
                <p class="mb-7">برای ورود ایمیل و رمز عبور خود را وارد کنید</p>
                <form class="space-y-5" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label for="email">ایمیل</label>
                        <input id="email" type="email" class="form-input" placeholder="ایمیل وارد کنید"
                         value="{{old('email')}}"   name="email" />
                    </div>
                    @error('email')
                            <p class="mt-1 text-danger">{{ $message }}</p>
                        @enderror
                    <div>
                        <label for="password">رمزعبور</label>
                        <input id="password" type="password" class="form-input" placeholder="رمزعبور  وارد کنید"
                            name="password" />
                        @error('password')
                            <p class="mt-1 text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="cursor-pointer">
                            <input id="remember_me" name="remember" type="checkbox" class="form-checkbox" />
                            <span class="text-white-dark">من را به خاطر بسپار</span>
                        </label>
                    </div>
                    <button type="submit" class="w-full btn btn-primary">ورود</button>
                </form>
                
                <p class="mt-4 text-center">
                      <a href="{{ route('password.request') }}"
                        class="font-bold text-primary hover:underline"> فراموشی رمزعبور</a>
                </p>
                
                <p class="mt-4 text-center">
                    حساب کاربری ندارید؟ <a href="{{ route('register') }}"
                        class="font-bold text-primary hover:underline">ثبت نام</a>
                </p>               
            </div>
        </div>
        <!-- end main content section -->
    </div>
@endsection
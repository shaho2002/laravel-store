@extends('auth.core.master')
@section('content')
    <div class="min-h-screen text-black main-container dark:text-white-dark">
        <div
            class="flex min-h-screen items-center justify-center bg-[url('../images/map.svg')] bg-cover bg-center dark:bg-[url('../images/map-dark.svg')]">
            <div class="panel m-6 w-full max-w-lg sm:w-[480px]">
                <div class="flex items-center mb-10">
                    <div class="ltr:mr-4 rtl:ml-4">
                        <img src="assets/images/profile-1.jpeg" class="object-cover w-16 h-16 rounded-full" alt="images" />
                    </div>
                    <div class="flex-1">
                        <h4 class="text-2xl"> {{ auth()->user()->name }} </h4>
                        <p>برای ورود به پنل لطفا ایمیل خود را تایید کنید</p>
                    </div>
                </div>
                @if (session('status') == 'verification-link-sent')
                    <div class="text-success">
                        <p>لینک تایید به ایمیل شما ارسال شد . لطفا ایمیل خود را چک کنید و در صورت دریافت نکردن لینک صفحه را
                            رفرش نمایید .</p>
                    </div>
                @else
                    <form class="space-y-5" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full btn btn-primary">ارسال لینک تایید</button>
                    </form>
                @endif

                <p class="mt-4 text-danger">
                    <a href="{{ route('logout') }}">خروج از حساب</a>
                </p>
            </div>
        </div>
    </div>
@endsection

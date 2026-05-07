@extends('auth.core.master')
@section('content')
<div class="min-h-screen text-black main-container dark:text-white-dark">
        <div
            class="flex min-h-screen items-center justify-center bg-[url('../images/map.svg')] bg-cover bg-center dark:bg-[url('../images/map-dark.svg')]">
            <div class="panel m-6 w-full max-w-lg sm:w-[480px]">
                <h2 class="mb-3 text-2xl font-bold">بازیابی رمز عبور</h2>
                @if (session('status'))
                <p class="text-success">{{ session('status') }}</p>
                
                @else
                <p class="mb-7">برای بازیابی رمز عبور لطفا ایمیل خود را وارد کنید</p>
                <form class="space-y-5" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div>
                        <label for="email">ایمیل</label>
                        <input id="email" type="email" class="form-input" placeholder="ایمیل خود را وارد کنید"
                         value="{{old('email')}}"   name="email" />
                    </div>
                    @error('email')
                            <p class="mt-1 text-danger">{{ $message }}</p>
                        @enderror
                            <button type="submit" class="w-full btn btn-primary">بازیابی</button>
                        @endif        
                   
                </form>
                
            </div>
        </div>
    </div>
@endsection
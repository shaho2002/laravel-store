@extends('auth.core.master')
@section('content')
<div class="min-h-screen text-black main-container dark:text-white-dark">
            <div class="flex min-h-screen items-center justify-center bg-[url('../images/map.svg')] bg-cover bg-center dark:bg-[url('../images/map-dark.svg')]">
                <div class="panel m-6 w-full max-w-lg sm:w-[480px]">
                    <h2 class="mb-3 text-2xl font-bold">تغییر رمزعبور </h2>
                    <p class="mb-7">رمزعبور خود را تغییر دهید</p>
                    <form class="space-y-5" method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <div><input type="hidden" name="token" value="{{ $request->route('token') }}"></div>
                        <div>
                            <label for="email">ایمیل</label>
                            <input id="email" type="email" class="form-input"  name="email" value="{{ old('email', $request->email) }}" />
                        </div>
                        @error('email')
                            <p class="mt-1 text-danger">{{ $message }}</p>
                        @enderror
                        <div>
                            <label for="password">رمزعبور</label>
                            <input id="password" type="password" class="form-input" placeholder="رمزعبور جدید را وارد کنید" name="password"  required/>
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
                        </div>
                        <button type="submit" class="w-full btn btn-primary"> تغییر رمزعبور</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
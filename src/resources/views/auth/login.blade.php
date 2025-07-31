@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}" />
@endsection

@section('nav')
<div class="header-nav">
    <div class="header-nav__register">
        <a class="header-nav__link-register" href="{{ route('register') }}">register</a>
    </div>
</div>
@endsection

@section('content')
<div class="login-form">
    <div class="login-form__heading">
        <h2 class="login-form__heading--h2">Login</h2>
    </div>
    <form class="login-form__wrapper" action="{{ route('login') }}" method="post">
        @csrf
        <div class="login-form__container">
            <div class="login-form__label">
                メールアドレス
            </div>
            <div class="login-form__inner">
                <div class="login-form__input-area">
                    <input class="login-form__input" type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                @error('email')
                <div class="login-form__error">
                    <div class="login-form__error-message">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
        </div>
        <div class="login-form__container">
            <div class="login-form__label">
                パスワード
            </div>
            <div class="login-form__inner">
                <div class="login-form__input-area">
                    <input class="login-form__input" type="password" name="password" placeholder="例: coachtech1106">
                </div>
                @error('password')
                <div class="login-form__error">
                    <div class="login-form__error-message">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
        </div>
        <div class="login-form__button-area">
            <button class="login-form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection
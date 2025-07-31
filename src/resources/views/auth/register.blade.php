@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}" />
@endsection

@section('nav')
<div class="header-nav">
    <div class="header-nav__login">
        <a class="header-nav__link-login" href="{{ route('login') }}">login</a>
    </div>
</div>
@endsection

@section('content')
<div class="register-form">
    <div class="register-form__heading">
        <h2 class="register-form__heading--h2">Register</h2>
    </div>
    <form class="register-form__wrapper" action="{{ route('register') }}" method="post">
        @csrf
        <div class="register-form__container">
            <div class="register-form__label">
                お名前
            </div>
            <div class="register-form__inner">
                <div class="register-form__input-area">
                    <input class="register-form__input" type="text" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}">
                </div>
                @error('name')
                <div class="register-form__error">
                    <div class="register-form__error-message">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
        </div>
        <div class="register-form__container">
            <div class="register-form__label">
                メールアドレス
            </div>
            <div class="register-form__inner">
                <div class="register-form__input-area">
                    <input class="register-form__input" type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                @error('email')
                <div class="register-form__error">
                    <div class="register-form__error-message">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
        </div>
        <div class="register-form__container">
            <div class="register-form__label">
                パスワード
            </div>
            <div class="register-form__inner">
                <div class="register-form__input-area">
                    <input class="register-form__input" type="password" name="password" placeholder="例: coachtech1106">
                </div>
                @error('password')
                <div class="register-form__error">
                    <div class="register-form__error-message">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
        </div>
        <div class="register-form__button-area">
            <button class="register-form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection
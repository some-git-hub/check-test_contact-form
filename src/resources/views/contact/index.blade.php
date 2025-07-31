@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/index.css') }}" />
@endsection

@section('content')
<div class="contact-form">
    <div class="contact-form__heading">
        <h2 class="contact-form__heading--h2">Contact</h2>
    </div>
    <form class="contact-form__wrapper" action="{{ route('contact.confirm') }}" method="post">
        @csrf
        <div class="contact-form__container">
            <div class="contact-form__label">
                <span class="contact-form__label--item">お名前</span>
                <span class="contact-form__label--required">※</span>
            </div>
            <div class="contact-form__inner">
                <div class="contact-form__input-area">
                    <input class="contact-form__input-name" type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                    <input class="contact-form__input-name" type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                </div>
                @error('last_name')
                <div class="contact-form__error">
                    <div class="contact-form__error-message--name-1">
                        {{ $message }}
                    </div>
                </div>
                @enderror
                @error('first_name')
                <div class="contact-form__error">
                    <div class="contact-form__error-message--name-2">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
        </div>
        <div class="contact-form__container">
            <div class="contact-form__label">
                <span class="contact-form__label--item">性別</span>
                <span class="contact-form__label--required">※</span>
            </div>
            <div class="contact-form__inner">
                <div class="contact-form__radio-area">
                    <label for="gender_male">
                        <input class="contact-form__radio-gender" type="radio" id="gender_male" name="gender" value="1" checked {{ old('gender') == '1' ? 'checked' : '' }}>
                            男性
                    </label>
                    <label for="gender_female">
                        <input class="contact-form__radio-gender" type="radio" id="gender_female" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                            女性
                    </label>
                    <label for="gender_other">
                        <input class="contact-form__radio-gender" type="radio" id="gender_other" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
                            その他
                    </label>
                </div>
                @error('gender')
                <div class="contact-form__error">
                    <div class="contact-form__error-message--gender">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
        </div>
        <div class="contact-form__container">
            <div class="contact-form__label">
                <span class="contact-form__label--item">メールアドレス</span>
                <span class="contact-form__label--required">※</span>
            </div>
            <div class="contact-form__inner">
                <div class="contact-form__input-area">
                    <input class="contact-form__input-email" type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                @error('email')
                <div class="contact-form__error">
                    <div class="contact-form__error-message">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
        </div>
        <div class="contact-form__container">
            <div class="contact-form__label">
                <span class="contact-form__label--item">電話番号</span>
                <span class="contact-form__label--required">※</span>
            </div>
            <div class="contact-form__inner">
                <div class="contact-form__input-area">
                    <input class="contact-form__input-tel" type="tel" name="tel_1" placeholder="080" value="{{ old('tel_1') }}">
                    <span class="contact-form__tel--hyphen">-</span>
                    <input class="contact-form__input-tel" type="tel" name="tel_2" placeholder="1234" value="{{ old('tel_2') }}">
                    <span class="contact-form__tel--hyphen">-</span>
                    <input class="contact-form__input-tel" type="tel" name="tel_3" placeholder="5678" value="{{ old('tel_3') }}">
                </div>
                @error('tel')
                <div class="contact-form__error">
                    <div class="contact-form__error-message">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
        </div>
        <div class="contact-form__container">
            <div class="contact-form__label">
                <span class="contact-form__label--item">住所</span>
                <span class="contact-form__label--required">※</span>
            </div>
            <div class="contact-form__inner">
                <div class="contact-form__input-area">
                    <input class="contact-form__input-address" type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                </div>
                @error('address')
                <div class="contact-form__error">
                    <div class="contact-form__error-message">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
        </div>
        <div class="contact-form__container">
            <div class="contact-form__label">
                <span class="contact-form__label--item">建物名</span>
            </div>
            <div class="contact-form__inner">
                <div class="contact-form__input-area">
                    <input class="contact-form__input-building" type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                </div>
            </div>
        </div>
        <div class="contact-form__container">
            <div class="contact-form__label">
                <span class="contact-form__label--item">お問い合わせの種類</span>
                <span class="contact-form__label--required">※</span>
            </div>
            <div class="contact-form__inner">
                <div class="contact-form__select-area">
                    <select class="contact-form__select-content" name="category_id" id="category_id">
                        <option value="">選択してください</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                <div class="contact-form__error">
                    <div class="contact-form__error-message">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
        </div>
        <div class="contact-form__container">
            <div class="contact-form__label">
                <span class="contact-form__label--item">お問い合わせ内容</span>
                <span class="contact-form__label--required">※</span>
            </div>
            <div class="contact-form__inner">
                <div class="contact-form__textarea-area">
                    <textarea class="contact-form__textarea-detail" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                </div>
                @error('detail')
                <div class="contact-form__error">
                    <div class="contact-form__error-message">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
        </div>
        <div class="contact-form__button-area">
            <button class="contact-form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection

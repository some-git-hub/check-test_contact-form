@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/confirm.css') }}" />
@endsection

@section('content')
<div class="confirm-table">
    <div class="confirm-table__heading">
        <h2 class="confirm-table__heading--h2">Confirm</h2>
    </div>
    <form class="confirm-table__wrapper" action="{{ route('contact.thanks') }}" method="post">
        @csrf
        <table class="confirm-table__container">
            <tr class="confirm-table__row">
                <th class="confirm-table__label">お名前</th>
                <td class="confirm-table__contents-area">
                    <input class="confirm-table__contents" type="text" value="{{ $name }}" readonly>
                    <input class="confirm-table__contents" type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                    <input class="confirm-table__contents" type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">性別</th>
                <td class="confirm-table__contents-area">
                    <input class="confirm-table__contents" type="text" value="{{ $genderLabels[$contact['gender']] }}" readonly>
                    <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">メールアドレス</th>
                <td class="confirm-table__contents-area">
                    <input class="confirm-table__contents" type="email" name="email" value="{{ $contact['email'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">電話番号</th>
                <td class="confirm-table__contents-area">
                    <input class="confirm-table__contents" type="tel" name="tel" value="{{ $contact['tel'] }}" readonly>
                    <input class="confirm-table__contents" type="hidden" name="tel_1" value="{{ $contact['tel_1'] }}">
                    <input class="confirm-table__contents" type="hidden" name="tel_2" value="{{ $contact['tel_2'] }}">
                    <input class="confirm-table__contents" type="hidden" name="tel_3" value="{{ $contact['tel_3'] }}">
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">住所</th>
                <td class="confirm-table__contents-area">
                    <input class="confirm-table__contents" type="text" name="address" value="{{ $contact['address'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">建物名
                </th>
                <td class="confirm-table__contents-area">
                    <input class="confirm-table__contents" type="text" name="building" value="{{ $contact['building'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">お問い合わせの種類</th>
                <td class="confirm-table__contents-area">
                    <input class="confirm-table__contents" type="text" value="{{ $categoryIdLabels[$contact['category_id']] }}" readonly>
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">お問い合わせ内容</th>
                <td class="confirm-table__contents-area--detail">
                    <textarea class="confirm-table__contents" name="detail" readonly>{{ $contact['detail'] }}</textarea>
                </td>
            </tr>
        </table>
        <div class="confirm-table__button-area">
            <button class="confirm-table__button-submit" type="submit" name="action" value="submit">送信</button>
            <button class="confirm-table__button-modify" type="submit" name="action" value="modify">修正</button>
        </div>
    </form>
</div>
@endsection
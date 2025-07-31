@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/thanks.css') }}" />
@endsection

@section('content')
<div class="thanks-page">
    <div class="thanks-page__inner">
        <p class="thanks-page__message">お問い合わせありがとうございました</p>
        <p class="thanks-page__background">Thank you</p>
        <div class="thanks-page__link">
            <a  class="thanks-page__link-home" href="/">HOME</a>
        </div>
    </div>
</div>
@endsection
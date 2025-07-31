@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}" />
@endsection

@section('nav')
<div class="header-nav">
    <form class="header-nav__logout" action="{{ route('logout') }}" method="post">
        @csrf
        <button class="header-nav__link-logout">logout</button>
    </form>
</div>
@endsection

@section('content')
<div class="admin-page__container">
    <div class="admin-page__heading">
        <h2 class="admin-page__heading--h2">Admin</h2>
    </div>
    <form class="search-form__container" action="{{ route('admin.search') }}" method="get">
        @csrf
        <div class="search-form__inner">
            <div class="search-form__input-area">
                <input class="search-form__input-keyword" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
            </div>
        </div>
        <div class="search-form__inner">
            <select class="search-form__select-gender" name="gender">
                <option value="" disabled {{ request('gender') === null ? 'selected' : '' }}>性別</option>
                <option value="all" {{ request('gender') === 'all' ? 'selected' : '' }}>すべて</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>
        </div>
        <div class="search-form__inner">
            <select class="search-form__select-content" name="category_id">
                <option value="" disabled {{ request('category_id') === null ? 'selected' : '' }}>お問い合わせの種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="search-form__inner">
            <div class="search-form__input-area">
                <input class="search-form__input-date" type="date" name="date" value="{{ request('date') }}">
            </div>
        </div>
        <div class="search-form__button">
            <button class="search-form__button-search" type="submit">検索</button>
        </div>
        <div class="search-form__link">
            <a class="search-form__link-reset" href="{{ route('admin.search') }}">リセット</a>
        </div>
    </form>
    <div class="export-and-pagination__container">
        <form class="export-form__button" action="{{ route('admin.export', request()->query()) }}" method="get">
            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
            <input type="hidden" name="gender" value="{{ request('gender') }}">
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            <input type="hidden" name="date" value="{{ request('date') }}">
            <button class="export-form__button-export" type="submit">エクスポート</button>
        </form>
        @if ($contacts->lastPage() > 1)
        <div class="pagination__inner">
            @if ($contacts->onFirstPage())
                <span class="pagination__left">&lt;</span>
            @else
                <a class="pagination__left" href="{{ $contacts->appends(request()->query())->previousPageUrl() }}">&lt;</a>
            @endif
            @foreach ($pages as $page)
                @if ($page == $contacts->currentPage())
                    <span class="pagination__number {{ $contacts->currentPage() == $page ? 'active' : '' }}">
                        {{ $page }}
                    </span>
                @else
                    <a class="pagination__number" href="{{ $contacts->appends(request()->query())->url($page) }}">
                        {{ $page }}
                    </a>
                @endif
            @endforeach
            @if ($contacts->hasMorePages())
                <a class="pagination__right" href="{{ $contacts->appends(request()->query())->nextPageUrl() }}">&gt;</a>
            @else
                <span class="pagination__right">&gt;</span>
            @endif
        </div>
        @else
        <div class="pagination__inner">
            <span class="pagination__left disabled">&lt;</span>
            <span class="pagination__number active">1</span>
            <span class="pagination__right disabled">&gt;</span>
        </div>
        @endif
    </div>
    <div class="contact-table__container">
        <table class="contact-table__inner">
            <tr class="contact-table__row-label">
                <td class="contact-table__label-name">お名前</td>
                <td class="contact-table__label-gender">性別</td>
                <td class="contact-table__label-email">メールアドレス</td>
                <td class="contact-table__label-categoryId">お問い合わせの種類</td>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="contact-table__row-item">
                <td class="contact-table__item-name">
                    <span class="contact-table__name-1">{{ $contact['last_name'] }}</span>
                    <span class="contact-table__name-2">{{ $contact['first_name'] }}</span>
                </td>
                <td class="contact-table__item-gender">
                    {{ $genderLabels[$contact['gender']] }}
                </td>
                <td class="contact-table__item-email">
                    {{ $contact['email'] }}
                </td>
                <td class="contact-table__item-categoryId">
                    {{ $categoryIdLabels[$contact['category_id']] }}
                </td>
                <td class="contact-table__item-details">
                    <div class="contact-table__link">
                        <a class="contact-table__link--details" href="#modal-{{ $contact['id'] }}">
                            詳細
                        </a>
                    </div>
                    <div class="details__wrapper" id="modal-{{ $contact['id'] }}">
                        <div class="details__container">
                            <div class="details__button">
                                <a class="details__button-close" href="#">☓</a>
                            </div>
                            <div class="details__inner">
                                <div class="details__row">
                                    <div class="details__label">お名前</div>
                                    <div class="details__item-name">
                                        <span class="details__name-1">{{ $contact['last_name'] }}</span>
                                        <span class="details__name-2">{{ $contact['first_name'] }}</span>
                                    </div>
                                </div>
                                <div class="details__row">
                                    <div class="details__label">性別</div>
                                    <div class="details__item-gender">
                                        {{ $genderLabels[$contact['gender']] }}
                                    </div>
                                </div>
                                <div class="details__row">
                                    <div class="details__label">メールアドレス</div>
                                    <div class="details__item-email">
                                        {{ $contact['email'] }}
                                    </div>
                                </div>
                                <div class="details__row">
                                    <div class="details__label">電話番号</div>
                                    <div class="details__item-tel">
                                        {{ $contact['tel'] }}
                                    </div>
                                </div>
                                <div class="details__row">
                                    <div class="details__label">住所</div>
                                    <div class="details__item-address">
                                        {{ $contact['address'] }}
                                    </div>
                                </div>
                                <div class="details__row">
                                    <div class="details__label">建物名</div>
                                    <div class="details__item-building">
                                        {{ $contact['building'] }}
                                    </div>
                                </div>
                                <div class="details__row">
                                    <div class="details__label">お問い合わせの種類</div>
                                    <div class="details__item-categoryId">
                                        {{ $categoryIdLabels[$contact['category_id']] }}
                                    </div>
                                </div>
                                <div class="details__row-detail">
                                    <div class="details__label">お問い合わせ内容</div>
                                    <div class="details__item-detail">
                                        {{ $contact['detail'] }}
                                    </div>
                                </div>
                                <form class="details__button" action="{{ route('admin.delete', ['id' => $contact['id']]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="details__button-delete" type="submit">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
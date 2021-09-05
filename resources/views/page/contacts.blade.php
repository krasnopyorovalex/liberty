@extends('layouts.app', [
    'className' => 'first-screen sub-page contacts',
    'bgImg' => is_mobile() ? $page->image_mob : ($page->image ? $page->image->path : '')
])

@section('title', $page->title)
@section('description', $page->description)
@push('og')
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($page->image ? $page->image->path : 'images/logo.png') }}">
    <meta property="og:description" content="{{ $page->description }}">
    <meta property="og:site_name" content="Фабрика дверей и мебели">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('first-screen')
    <div class="first-screen-text">
        <div class="text">
            <h1>{{ $page->name }}</h1>
            <div class="flex">
                @if($page->text)
                    <div class="info">
                        {!! $page->text !!}
                    </div>
                @endif
                <div class="btn-box">
                    <div class="btn recall-me call-popup" data-target="popup-recall-me">заказать звонок</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="breadcrumbs">
        <ul>
            <li><a href="{{ route('page.show') }}">Главная</a></li>
            <li>{{ $page->name }}</li>
        </ul>
    </div>

    <section class="contacts-text">
        <div class="container-full section-header">
            <div class="row">
                <div class="section-sub-title">
                    КОНТАКТНАЯ ИНФОРМАЦИЯ
                    <div class="decoration-line wow slideInLeft"></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-item">
                        <div class="contact-item-text">
                            <div class="title uppercase">НАХИМ-ДЕКОР</div>
                            <p>
                                Адрес:<br/>
                                г. Москва, Decor Expo, Нахимовский проспект, д. 24, Сектор З, Место Г - 9<br/>
                                Телефон:<br/>
                                <a href="tel:+74993488599">+7 499-348-85-99</a><br/>
                                Email:<br/>
                                <a href="mailto:liberti-decor_expo@mail.ru">liberti-decor_expo@mail.ru</a>
                            </p>
                        </div>
                        <div class="map">
                            <img src="../img/map.jpg" alt="map" />
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-item-text">
                            <div class="title uppercase">соло</div>
                            <p>
                                Адрес:<br/>
                                г. Москва, Decor Expo, Нахимовский проспект, д. 24, Сектор З, Место Г - 9<br/>
                                Телефон:<br/>
                                <a href="tel:+74993488599">+7 499-348-85-99</a><br/>
                                Email:<br/>
                                <a href="mailto:liberti-decor_expo@mail.ru">liberti-decor_expo@mail.ru</a>
                            </p>
                        </div>
                        <div class="map">
                            <img src="../img/map.jpg" alt="map" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-full section-header">
            <div class="row">
                <div class="section-sub-title fabrics">
                    ФАБРИКА
                    <div class="decoration-line wow slideInLeft"></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-item">
                        <div class="contact-item-text">
                            <div class="title uppercase">ЛИБЕРТИ</div>
                            <p>
                                Адрес:<br/>
                                г. Москва, Decor Expo, Нахимовский проспект, д. 24, Сектор З, Место Г - 9<br/>
                                Телефон:<br/>
                                <a href="tel:+74993488599">+7 499-348-85-99</a><br/>
                                Email:<br/>
                                <a href="mailto:liberti-decor_expo@mail.ru">liberti-decor_expo@mail.ru</a>
                            </p>
                        </div>
                        <div class="map">
                            <img src="../img/map.jpg" alt="map" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.sections.for-customers')
@endsection

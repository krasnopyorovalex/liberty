@extends('layouts.app', [
    'className' => 'first-screen sub-page for-clients',
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
    @include('layouts.sections.for-clients')
    <section class="form-cost-calculation-content-box">
        <div class="form-box">
            <div class="title">Расчет проекта</div>
            @include('layouts.forms.cost-calculation')
        </div>
    </section>

    @include('layouts.sections.why-choose-us')
    @include('layouts.sections.for-customers')
@endsection

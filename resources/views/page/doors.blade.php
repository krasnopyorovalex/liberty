@extends('layouts.app', [
    'className' => 'first-screen sub-page doors',
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
            <div class="digit">01.</div>
            <h1>{{ $page->name }}</h1>
            <div class="info">
                {!! $page->text !!}
            </div>
            <div class="btn-box">
                <div class="btn recall-me call-popup" data-target="popup-recall-me">заказать звонок</div>
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
    <section class="doors-list">
        <div class="container-full section-header">
            <div class="row">
                <div class="section-sub-title">
                    {{ $page->sub_title }}
                    <div class="decoration-line wow slideInLeft"></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row flex-start">
                <div class="col-12">
                    @include('layouts.sections.doors')
                </div>
            </div>
        </div>
    </section>
    @include('layouts.sections.why-choose-us')
    @include('layouts.sections.for-customers')
@endsection

@extends('layouts.app', [
    'className' => 'first-screen sub-page rybrika'
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
    @if($page->slider)
    <div class="main-slider with-arrows rybrika-slider">
        <div class="owl-carousel owl-theme">
            @foreach(change_images_slider($page->slider) as $image)
                <div class="main-slider-item">
                    <picture>
                        <img src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                    </picture>
                    <div class="main-slider-item-desc">
                        <p>{!! $image->text !!}</p>
                        <div class="btn-main-slider-box">
                            <div class="btn call-popup" data-target="popup-recall-me">заказать звонок</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="title"><span>{{ $page->name }}</span></div>
    </div>
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('page.show') }}">Главная</a></li>
                        <li><a href="{{ route('page.show', ['alias' => 'furniture']) }}">Мебель</a></li>
                        <li>{{ $page->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.sections.furniture', ['furnitureList' => $furnitureList])
    @include('layouts.sections.collections', ['collections' => $collections])
    @include('layouts.sections.why-choose-us')
    @include('layouts.sections.for-customers')
@endsection

@extends('layouts.app', [
    'className' => 'first-screen sub-page rybrika'
])

@section('title', $collection->title)
@section('description', $collection->description)
@push('og')
    <meta property="og:title" content="{{ $collection->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($collection->image ?: 'images/logo.png') }}">
    <meta property="og:description" content="{{ $collection->description }}">
    <meta property="og:site_name" content="Фабрика дверей и мебели">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('first-screen')
    <div class="main-slider with-arrows rybrika-slider">
        <div class="owl-carousel owl-theme">
            @foreach($collection->getImages() as $image)
                <div class="main-slider-item">
                    <picture>
                        <img src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                    </picture>
                    <div class="main-slider-item-desc">
                        @if($image->text)
                        <p>{!! $image->text !!}</p>
                        @endif
                        <div class="btn-main-slider-box">
                            <div class="btn call-popup" data-target="popup-recall-me">заказать звонок</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="title">{!! $collection->name !!}</div>
    </div>
@endsection

@section('content')
    @if($collection->catalog_file)
        <div class="download uppercase">
            <a href="{{ asset($collection->catalog_file) }}" target="_blank">Скачать каталог коллекции</a>
            <div class="decoration-line wow slideInLeft"></div>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('page.show') }}">Главная</a></li>
                        <li>{{ strip_tags($collection->name) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.sections.furniture', ['furnitureList' => $furnitureList])
@endsection

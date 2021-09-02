@extends('layouts.app', ['className' => 'first-screen'])

@section('title', $door->title)
@section('description', $door->description)
@push('og')
    <meta property="og:title" content="{{ $door->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($door->image ? $door->image : 'images/logo.png') }}">
    <meta property="og:description" content="{{ $door->description }}">
    <meta property="og:site_name" content="Фабрика дверей и мебели">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('first-screen')
    @if($door->slider)
        <div class="main-slider with-arrows door-card-slider">
            <div class="owl-carousel owl-theme">
                @foreach(change_images_slider($door->slider) as $image)
                    <div class="main-slider-item">
                        <picture>
                            <img src="{{ asset($image->getPath()) }}" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                        </picture>
                        <div class="main-slider-item-desc">
                            <div class="door-card-slider-text">
                                <h1 class="uppercase">{{ $image->name }}</h1>
                                <p>{{ $image->text }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection

@section('content')
<div class="container-full">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumbs-door-card">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><a href="{{ route('page.show', ['alias' => 'doors']) }}">Двери</a></li>
                        <li>{{ $door->name }}</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="section-header door-card-header">
    <div class="section-sub-title">
        <span>Артикул: {{ $door->articul }}</span>
        @foreach($door->doorAttributes as $attr)
        <span>{{ $attr->name }}: {{ $attr->pivot->value }}</span>
        @endforeach
        <div class="decoration-line wow slideInLeft"></div>
    </div>
</div>

<section class="door-card-info">
    <div class="container-full">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row flex-stretch">
                    <div class="col-6">
                        <div class="door-card-gallery-box">
                            <div class="door-card-gallery owl-carousel owl-theme">
                                @foreach($door->getImages() as $image)
                                    <div class="door-card-gallery-item">
                                        <a href="{{ $image->getPath() }}" data-lightbox="gallery">
                                            <picture>
                                                <img src="{{ $image->getPath() }}">
                                            </picture>
                                            {{ svg('zoom-in') }}
                                        </a>
                                        {{ svg('favorite') }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="door-card-price-box flex">
                                <div class="price-name-box flex">
                                    <div class="price">{!! $door->getPrice() !!}</div>
                                    <div class="name uppercase">{{ $door->name }}</div>
                                </div>
                                <div class="btn btn-buy call-popup" data-target="popup-recall-me">купить</div>
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="tabs-flex-column flex">
                            <div class="tabs">
                                <ul>
                                    <li class="active">Раскладки</li>
                                    <li>Отделки</li>
                                    <li>Наличники</li>
                                    <li>В интерьере</li>
                                </ul>
                                <div class="content">
                                    <div>
                                        <div class="door-card-options">
                                            <div class="row">
                                                <div class="col-3">
                                                    @foreach($door->modifications as $modification)
                                                        <div class="door-card-options-item active">
                                                            <div class="img">
                                                                <img src="{{ asset(is_mobile() ? $modification->image_mob : $modification->image) }}" alt="{{ $modification->name }}">
                                                            </div>
                                                            <div class="name">
                                                                {{ $modification->articul }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="colors flex flex-start">
                                                    <div class="colors-col">
                                                        @foreach($door->finishing_options as $idx => $opt)
                                                            <div class="colors-col-item flex flex-end" style="background-color: {{ $opt }};">
                                                                <div class="label">{{ $door->finishing_option_names[$idx] ?? '' }}</div>
                                                            </div>
                                                            @if(($loop->index + 1) % 5 === 0)
                                                            </div>
                                                            <div class="colors-col">
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="door-card-options">
                                            Раздел находится в разработке
                                        </div>
                                    </div>
                                    <div>
                                        <div class="door-card-options">
                                            Раздел находится в разработке
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tabs-custom">
                                <ul>
                                    <li class="active" data-page="0">Описание</li>
                                    <li data-page="1">Гарантия</li>
                                    <li data-page="2">Сроки</li>
                                    <li data-page="3">Скачать 3D</li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="door-card-tabs-custom">
                            <div class="door-card-tabs-custom-item">
                                {!! $door->text !!}
                                <div class="decoration-line wow slideInLeft"></div>
                            </div>
                            <div class="door-card-tabs-custom-item">
                                {!! $door->guarantee !!}
                                <div class="decoration-line wow slideInLeft"></div>
                            </div>
                            <div class="door-card-tabs-custom-item">
                                {!! $door->timing !!}
                                <div class="decoration-line wow slideInLeft"></div>
                            </div>
                            <div class="door-card-tabs-custom-item">
                                ///
                                <div class="decoration-line wow slideInLeft"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</section>

<section class="door-cards-slider">
    <div class="slider-projects with-arrows owl-theme owl-carousel">
        @foreach(change_images_slider($door->doorInteriorSlider) as $image)
            <div class="slider-projects-item">
                <img src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                <div class="slider-projects-item-desc">
                    <div class="decoration-line wow slideInLeft"></div>
                    <div class="title">{{ $image->name }}</div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@if($relatedDoors->count())
    <section>
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="related-products">
                        <div class="related-products-title uppercase">похожие товары</div>
                        <div class="doors-cards">
                            @foreach($relatedDoors as $relatedDoor)
                                <div class="doors-cards-item">
                                    <a href="{{ $relatedDoor->url }}">
                                        <div class="doors-cards-item-img">
                                            <img src="{{ change_image_desktop_mob($relatedDoor) }}" alt="{{ $relatedDoor->name }}">
                                            <div class="decoration-line"></div>
                                        </div>
                                        <div class="doors-cards-item-info flex">
                                            <div class="doors-cards-item-info-title">{{ $relatedDoor->name }}</div>
                                            <div class="doors-cards-item-info-cost">
                                                <div class="cost-value">{!! $relatedDoor->getPrice() !!}</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </section>
@endif
@include('layouts.sections.why-choose-us')
@endsection
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
                                @foreach($door->images as $image)
                                    <div class="door-card-gallery-item">
                                        <a href="{{ $image->getPath() }}" data-lightbox="gallery">
                                            <picture>
                                                <source media="(max-width: 670px)" srcset="{{ $image->getMobileImage() }}">
                                                <img src="{{ $image->getDesktopImage() }}" alt="{{ $image->name }}">
                                            </picture>
                                            {{ svg('zoom-in') }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            @if($isFavorite)
                                <div class="favorite-action" data-action="{{ route('favorite.remove', $door) }}" data-entity="{{ get_class($door) }}">
                                    {{ svg('favorite-active') }}
                                </div>
                            @else
                                <div class="favorite-action" data-action="{{ route('favorite.add', $door) }}" data-entity="{{ get_class($door) }}">
                                    {{ svg('favorite') }}
                                </div>
                            @endif
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
                                                    @if($door->parent)
                                                        <div class="door-card-options-item active">
                                                            <div class="img">
                                                                <a href="{{ $door->parent->url }}">
                                                                    <img src="{{ asset(is_mobile() ? $door->parent->image_mob : $door->parent->image) }}" alt="{{ $door->parent->name }}">
                                                                </a>
                                                            </div>
                                                            <div class="name">
                                                                {{ $door->parent->articul }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @foreach($door->modifications as $modification)
                                                        <div class="door-card-options-item active">
                                                            <div class="img">
                                                                <a href="{{ $modification->url }}">
                                                                    <img src="{{ asset(is_mobile() ? $modification->image_mob : $modification->image) }}" alt="{{ $modification->name }}">
                                                                </a>
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
                                                        @foreach($door->textures as $texture)
                                                            <div class="colors-col-item flex flex-end">
                                                                <img src="{{ asset($texture->path) }}" alt="{{ $texture->label }}" />
                                                                <div class="label">{{ $texture->label }}</div>
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

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="colors flex flex-start">
                                                    <div class="colors-col">
                                                        @foreach($door->textures->chunk(6) as $chunk)
                                                            <div class="row">
                                                                @foreach($chunk as $texture)
                                                                    <div class="col-2">
                                                                        <img src="{{ asset($texture->path) }}" alt="{{ $texture->label }}" />
                                                                    </div>
                                                                @endforeach
                                                                @if(count($chunk) < 6)
                                                                    @for($i = 0; $i < 6 - count($chunk); $i++)
                                                                        <div class="col-2">
                                                                            <img src="{{ asset('img/placeholder-texture.jpg') }}" alt="">
                                                                        </div>
                                                                    @endfor
                                                                @endif
                                                            </div>
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
                                    @if($door->file)
                                        <li>
                                            <a href="{{ route('file.download', ['file' => $door->file]) }}">
                                                Скачать 3D
                                            </a>
                                        </li>
                                    @endif
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

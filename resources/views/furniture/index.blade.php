@extends('layouts.app', [
    'className' => ''
])

@section('title', $furniture->title)
@section('description', $furniture->description)
@push('og')
    <meta property="og:title" content="{{ $furniture->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($furniture->image ?: 'images/logo.png') }}">
    <meta property="og:description" content="{{ $furniture->description }}">
    <meta property="og:site_name" content="Фабрика дверей и мебели">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
<div class="container-full">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumbs-p-o">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('page.show') }}">Главная</a></li>
                        <li><a href="{{ $furniture->collection->url }}">{{ strip_tags($furniture->collection->name) }}</a></li>
                        <li>{{ $furniture->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="collection-pagination">
    <div class="container-full">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-5">
                <div class="title">
                    {{ $furniture->name }}
                    <div class="decoration-line wow slideInLeft"></div>
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-5">
                <div class="next-prev-arrows flex">
                    <a href="#"><span class="next-arrow"></span></a>
                    <div>Следующая модель</div>
                    <a href="#"><span class="prev-arrow"></span></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="door-card-info">
    <div class="container-full">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row flex-stretch">
                    <div class="col-6">
                        <div class="door-card-gallery-box">
                            <div class="door-card-gallery owl-carousel owl-theme">
                                @foreach($furniture->getImages() as $image)
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
                                    <div class="price">{!! $furniture->getPrice() !!}</div>
                                    <div class="name uppercase">{{ $furniture->name }}</div>
                                </div>
                                <div class="btn btn-buy call-popup" data-target="popup-recall-me">купить</div>
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="flex-column">
                            <div class="btn-buy-box hidden-sm">
                                <div class="btn">Купить</div>
                            </div>
                            @if($furniture->furnitureAttributes)
                                <div class="options">
                                    @foreach($furniture->furnitureAttributes as $attr)
                                        <div class="options-item flex">
                                            <div class="options-item-attr">{{ $attr->name }}:</div>
                                            <div class="options-item-value">{{ $attr->pivot->value }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if($furniture->finishing_options)
                                <div class="finishing-options">
                                    <div class="title">Варианты отделок:</div>
                                    <div class="flex">
                                        @foreach($furniture->finishing_options as $opt)
                                            <div class="finishing-options-item" style="background-color: {{ $opt }}"></div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

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
                                {!! $furniture->text !!}
                                <div class="decoration-line wow slideInLeft"></div>
                            </div>
                            <div class="door-card-tabs-custom-item">
                                {!! $furniture->guarantee !!}
                                <div class="decoration-line wow slideInLeft"></div>
                            </div>
                            <div class="door-card-tabs-custom-item">
                                {!! $furniture->timing !!}
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
        @foreach(change_images_slider($furniture->furnitureInteriorSlider) as $image)
            <div class="slider-projects-item">
                <img src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}">
                <div class="slider-projects-item-desc">
                    <div class="decoration-line wow slideInLeft"></div>
                    <div class="title">{{ $image->name }}</div>
                </div>
            </div>
        @endforeach
    </div>
</section>

@if($anotherProjects->count())
    <section class="another-projects-in-collection">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div>
                        <div class="title">
                            Другие предметы коллекции
                            <div class="decoration-line wow slideInLeft"></div>
                        </div>
                        <div class="doors-cards">
                            @foreach($anotherProjects as $anotherProject)
                                <div class="doors-cards-item">
                                    <div class="doors-cards-item-img">
                                        <picture>
                                            <source media="(max-width: 670px)" srcset="{{ $anotherProject->image_mob }}">
                                            <img src="{{ asset($anotherProject->image) }}">
                                        </picture>
                                        <div class="decoration-line wow slideInLeft"></div>
                                    </div>
                                    <div class="doors-cards-item-info flex">
                                        <div class="doors-cards-item-info-title">{{ $anotherProject->name }}</div>
                                        <div class="doors-cards-item-info-cost">
                                            <div class="cost-value">{!! $anotherProject->getPrice() !!}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
@include('layouts.sections.collections', ['collections' => $collections->whereNotIn('id', $furniture->collection->id)])
@include('layouts.sections.why-choose-us')
@include('layouts.sections.for-customers')
@endsection

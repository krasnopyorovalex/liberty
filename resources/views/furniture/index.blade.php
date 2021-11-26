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
                        <li><a href="{{ route('page.show', ['alias' => 'furniture']) }}">Мебель</a></li>
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
                    @if($nextPrevDto->prev)
                        <a href="{{ $nextPrevDto->prev->url }}"><span class="next-arrow"></span></a>
                    @endif
                    <div>Следующая модель</div>
                    @if($nextPrevDto->next)
                        <a href="{{ $nextPrevDto->next->url }}"><span class="prev-arrow"></span></a>
                    @endif
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
                                @foreach($furniture->images as $image)
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
                                <div class="favorite-action is-favorite" data-action="{{ route('favorite.remove', $furniture) }}" data-entity="{{ get_class($furniture) }}">
                                    {{ svg('favorite-active') }}
                                </div>
                            @else
                                <div class="favorite-action" data-action="{{ route('favorite.add', $furniture) }}" data-entity="{{ get_class($furniture) }}">
                                    {{ svg('favorite') }}
                                </div>
                            @endif
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
                                <div class="btn call-popup" data-target="popup-recall-me">Купить</div>
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

                            @if($furniture->textures)
                                <div class="finishing-options">
                                    <div class="title">Варианты отделок:</div>
                                    <div class="flex">
                                        @foreach($furniture->textures->chunk(6) as $chunk)
                                            <div class="row">
                                                @foreach($chunk as $texture)
                                                    <div class="col-2">
                                                        <a href="{{ asset($texture->path) }}" data-lightbox="textures">
                                                            <img src="{{ asset($texture->path) }}" alt="{{ $texture->label }}" />
                                                        </a>
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
                            @endif

                            <div class="tabs-custom">
                                <ul>
                                    <li class="active" data-page="0">Описание</li>
                                    <li data-page="1">Гарантия</li>
                                    <li data-page="2">Сроки</li>
                                    @if($furniture->file)
                                        <li>
                                            <a href="{{ route('file.download', ['file' => $furniture->file]) }}">
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
                                @if($furniture->file)
                                    <a href="{{ asset($furniture->file) }}" class="btn" target="_blank">Скачать</a>
                                @endif
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
                                    <a href="{{ $anotherProject->url }}">
                                        <div class="doors-cards-item-img">
                                            <picture>
                                                <source media="(max-width: 670px)" srcset="{{ $anotherProject->getMobileImage() }}">
                                                <img src="{{ asset($anotherProject->getDesktopImage()) }}">
                                            </picture>
                                            <div class="decoration-line wow slideInLeft"></div>
                                        </div>
                                        <div class="doors-cards-item-info flex">
                                            <div class="doors-cards-item-info-title">{{ $anotherProject->name }}</div>
                                            <div class="doors-cards-item-info-cost">
                                                <div class="cost-value">{!! $anotherProject->getPrice() !!}</div>
                                            </div>
                                        </div>
                                    </a>
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

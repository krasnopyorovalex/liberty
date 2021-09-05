@extends('layouts.app', [
    'className' => 'first-screen sub-page interior'
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
    <section class="first-screen sub-page interior" style="background-image: url({{ is_mobile() ? $page->image_mob : ($page->image ? $page->image->path : '') }})">
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-6">
                    <div class="interior-h1">
                        <div class="digit">03.</div>
                        <h1>{{ $page->name }}</h1>
                    </div>
                </div>
                <div class="col-5">
                    <div class="text">
                        {!! $page->text !!}
                        <div class="btn call-popup" data-target="popup-recall-me">заказать звонок</div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('content')
    <div class="breadcrumbs">
        <ul>
            <li><a href="{{ route('page.show') }}">Главная</a></li>
            <li>{{ $page->name }}</li>
        </ul>
    </div>

    <section class="interior-categories">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header visible-sm">
                        <div class="section-title wow slideInLeft">реализованные объекты</div>
                        <div class="section-sub-title wow slideInLeft">
                            Авторские интерьеры
                            по индивидуальным проектам
                            <div class="decoration-line"></div>
                        </div>
                    </div>

                    <div class="interior-categories-box hidden-sm">
                        <div class="row">
                            @foreach($portfolioTypes as $portfolioType)
                            <div class="col-3">
                                <div class="interior-categories-box-item hovered">
                                    <a href="{{ request()->url() }}?type={{ $portfolioType->id }}">{{ $portfolioType->name }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($portfolio->count())
        <section class="interior-projects">
            @foreach($portfolio as $portfolioItem)
            <div class="interior-projects-item">
                <div class="slider-projects owl-theme owl-carousel">
                    @foreach($portfolioItem->getImages() as $image)
                        <div class="slider-projects-item">
                            <picture>
                                <img src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}">
                            </picture>
                        </div>
                    @endforeach
                </div>
                <div class="decoration-line wow slideInLeft visible-sm"></div>
                <div class="slider-projects-desc hidden-sm">
                    {!! $portfolioItem->text !!}
                </div>
                <div class="btn-box">
                    <a href="{{ $portfolioItem->url }}" class="btn">смотреть проект</a>
                </div>
                <div class="interior-projects-title uppercase">
                    {{ $portfolioItem->name }}
                </div>
            </div>
            @endforeach
        </section>
    @endif
    @include('layouts.sections.why-choose-us')
@endsection

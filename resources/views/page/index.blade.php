@extends('layouts.app', ['className' => 'with-absolute-header index-page'])

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
        @desktop
            @include('layouts.first-screens.page-index', ['images' => $page->slider->images])
        @elsedesktop
            @include('layouts.first-screens.page-index', ['images' => $page->slider->imagesMob])
        @enddesktop
    @endif
@endsection

@section('content')
    <section class="sales-leaders">
        <div class="section-header">
            <div class="section-title wow slideInLeft">лидеры продаж</div>
            <div class="section-sub-title wow slideInLeft">
                Мелодии, которые всегда будут звучать в Вашем доме
                <div class="decoration-line"></div>
            </div>
        </div>
        <div class="sales-leaders-slider owl-theme owl-carousel">
            <div class="sales-leaders-slider-item flex">
                <div class="sales-leaders-slider-item-img-single">
                    <img src="img/sales-leaders-slider-img-01.jpg" alt="alt">
                    <div class="decoration-line"></div>
                    <div class="title flex">
                        <a href="#">коллекция «нота»</a>
                    </div>
                </div>
                <div class="sales-leaders-slider-item-img-double">
                    <div class="sales-leaders-slider-item-img-single">
                        <img src="img/sales-leaders-slider-img-02.jpg" alt="alt">
                        <div class="decoration-line"></div>
                        <div class="title flex">
                            <a href="#">Коллекция «Аккорд»</a>
                        </div>
                    </div>
                    <div class="sales-leaders-slider-item-img-single">
                        <img src="img/sales-leaders-slider-img-03.jpg" alt="alt">
                        <div class="decoration-line"></div>
                        <div class="title flex">
                            <a href="#">дверь межкомнатная «фламенко»</a>
                        </div>
                    </div>
                </div>
                <div class="sales-leaders-slider-item-img-single">
                    <img src="img/sales-leaders-slider-img-04.jpg" alt="alt">
                    <div class="decoration-line"></div>
                    <div class="title flex">
                        <a href="#">дверь межкомнатная «фламенко»</a>
                    </div>
                </div>
            </div>
            <div class="sales-leaders-slider-item flex">
                <div class="sales-leaders-slider-item-img-single">
                    <img src="img/sales-leaders-slider-img-01.jpg" alt="alt">
                    <div class="decoration-line"></div>
                    <div class="title flex">
                        <a href="#">коллекция «нота»</a>
                    </div>
                </div>
                <div class="sales-leaders-slider-item-img-double">
                    <div class="sales-leaders-slider-item-img-single">
                        <img src="img/sales-leaders-slider-img-02.jpg" alt="alt">
                        <div class="decoration-line"></div>
                        <div class="title flex">
                            <a href="#">Коллекция «Аккорд»</a>
                        </div>
                    </div>
                    <div class="sales-leaders-slider-item-img-single">
                        <img src="img/sales-leaders-slider-img-03.jpg" alt="alt">
                        <div class="decoration-line"></div>
                        <div class="title flex">
                            <a href="#">дверь межкомнатная «фламенко»</a>
                        </div>
                    </div>
                </div>
                <div class="sales-leaders-slider-item-img-single">
                    <img src="img/sales-leaders-slider-img-04.jpg" alt="alt">
                    <div class="decoration-line"></div>
                    <div class="title flex">
                        <a href="#">дверь межкомнатная «фламенко»</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="center">
            <a href="#" class="btn btn-more-leaders">больше проектов</a>
        </div>
        <div class="sales-leaders-slider-mobile visible-sm">
            <div class="owl-theme owl-carousel">
                <div class="sales-leaders-slider-item">
                    <div class="sales-leaders-slider-item-img-single">
                        <img src="img/sales-leaders-slider-mob.jpg" alt="alt">
                        <div class="title flex">
                            <a href="#">коллекция «нота»</a>
                        </div>
                    </div>
                </div>
                <div class="sales-leaders-slider-item">
                    <div class="sales-leaders-slider-item-img-single">
                        <img src="img/sales-leaders-slider-mob.jpg" alt="alt">
                        <div class="title flex">
                            <a href="#">Коллекция «Аккорд»</a>
                        </div>
                    </div>
                </div>
                <div class="sales-leaders-slider-item">
                    <div class="sales-leaders-slider-item-img-single">
                        <img src="img/sales-leaders-slider-mob.jpg" alt="alt">
                        <div class="title flex">
                            <a href="#">дверь межкомнатная «фламенко»</a>
                        </div>
                    </div>
                </div>
                <div class="sales-leaders-slider-item">
                    <div class="sales-leaders-slider-item-img-single">
                        <img src="img/sales-leaders-slider-mob.jpg" alt="alt">
                        <div class="title flex">
                            <a href="#">дверь межкомнатная «фламенко»</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.sections.why-choose-us')
    @include('layouts.sections.how-we-work')
    @include('layouts.sections.premium-slider')
    @include('layouts.sections.authors')
    @include('layouts.sections.for-customers')
@endsection

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
        @include('layouts.first-screens.page-index', ['images' => change_images_slider($page->slider)])
    @endif
@endsection

@section('content')
    @include('layouts.sections.sales-leaders')
    @include('layouts.sections.why-choose-us')
    @include('layouts.sections.how-we-work')
    @include('layouts.sections.premium-slider')
    <section class="authors">
        <div class="section-header">
            <div class="section-title wow slideInLeft">авторы проектов</div>
            <div class="section-sub-title wow slideInLeft">
                Художники и дизайнеры нашей фабрики и других дизайн-студий
                <div class="decoration-line"></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('layouts.sections.authors')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="about-us-box center">
                        <a href="#" class="btn">узнать больше о нас</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.sections.for-customers')
@endsection

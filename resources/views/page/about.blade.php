@extends('layouts.app', ['className' => 'with-absolute-header sub-page about'])

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
    @include('layouts.first-screens.page-about')
@endsection

@section('content')
    <div class="breadcrumbs">
        <ul>
            <li><a href="{{ route('page.show') }}">Главная</a></li>
            <li>{{ $page->name }}</li>
        </ul>
    </div>

    <section class="about-text">
        @if($page->sub_title)
        <div class="container-full section-header">
            <div class="row">
                <div class="section-sub-title">
                    {{ $page->sub_title }}
                    <div class="decoration-line wow slideInLeft"></div>
                </div>
            </div>
        </div>
        @endif
        <div class="about-text-seo">
            {!! $page->text !!}
        </div>
    </section>

    <section class="video">
        <iframe width="100%" height="{{ is_mobile() ? '500' : '827' }}" src="https://www.youtube.com/embed/7UNIwBtYEDE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </section>

    @include('layouts.sections.about-blocks')

    @include('layouts.sections.authors')
@endsection

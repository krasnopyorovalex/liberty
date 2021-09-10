@extends('layouts.app', ['className' => ''])

@section('title', $author->title)
@section('description', $author->description)
@push('og')
    <meta property="og:title" content="{{ $author->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($author->image ? $author->image->path : 'images/logo.png') }}">
    <meta property="og:description" content="{{ $author->description }}">
    <meta property="og:site_name" content="Фабрика дверей и мебели">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs-p-o">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('page.show') }}">Главная</a></li>
                            <li>{{ $author->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="employee-info">
        <div class="container">
            <div class="row flex-stretch">
                <div class="col-8">
                    <div class="employee-info-body">
                        <div class="employee-info-body-name hovered">
                            {{ $author->name }}
                        </div>
                        <div class="employee-info-body-photo visible-sm">
                            @if($author->image)
                                <img src="{{ asset($author->image->path) }}" alt="Фото автора: {{ $author->name }}">
                            @endif
                        </div>
                        <div class="employee-info-body-text">
                            {!! $author->text !!}
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="employee-info-body-photo hidden-sm">
                        @if($author->image)
                            <img src="{{ asset($author->image->path) }}" alt="Фото автора: {{ $author->name }}">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="employee-projects">
        <div class="container">
            @if($author->furniture)
            <div class="row">
            @foreach($author->furniture as $furniture)
                <div class="col-4">
                    <div class="employee-projects-item">
                        <div class="employee-projects-item-img hovered">
                            <picture>
                                <source media="(max-width: 670px)" srcset="{{ $furniture->image_mob }}">
                                <img src="{{ asset($furniture->image) }}">
                            </picture>
                        </div>
                        <div class="employee-projects-item-info uppercase">
                            <a href="{{ $furniture->url }}">{{ $furniture->name }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            @endif

            @if($author->doors)
                <div class="row">
                    @foreach($author->doors as $door)
                        <div class="col-4">
                            @include('layouts.partials._door_item', ['entity' => $door])
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    @if($author->interiors)
        <div class="interior-projects">
        @foreach($author->interiors as $interior)
            @include('layouts.partials._portfolio_item', ['entity' => $interior])
        @endforeach
        </div>
    @endif
@endsection

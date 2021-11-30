@extends('layouts.app', [
    'className' => ''
])

@section('title', $portfolio->title)
@section('description', $portfolio->description)
@push('og')
    <meta property="og:title" content="{{ $portfolio->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($portfolio->image ? $portfolio->image : 'images/logo.png') }}">
    <meta property="og:description" content="{{ $portfolio->description }}">
    <meta property="og:site_name" content="Фабрика дверей и мебели">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    <div class="breadcrumbs">
        <ul>
            <li><a href="{{ route('page.show') }}">Главная</a></li>
            <li><a href="{{ route('page.show', ['alias' => 'portfolio']) }}">Портфолио</a></li>
            <li>{{ $portfolio->name }}</li>
        </ul>
    </div>

    <div class="with-arrows with-digits interior-card-slider slider-thumb">
        <div class="owl-carousel owl-theme">
            @foreach($portfolio->getImages() as $image)
            <div class="interior-card-slider-item">
                <img src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                @if($image->text)
                <div class="interior-card-slider-item-desc board">
                    <div class="btn-show-hide"></div>
                    <p>{{ $image->text }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        <div class="digits">
            <span>1</span>/{{ $portfolio->getImages()->count() }}
            @if($isFavorite)
                <div class="favorite-action is-favorite" data-action="{{ route('favorite.remove', $portfolio) }}" data-entity="{{ get_class($portfolio) }}">
                    {{ svg('favorite-active') }}
                </div>
            @else
                <div class="favorite-action" data-action="{{ route('favorite.add', $portfolio) }}" data-entity="{{ get_class($portfolio) }}">
                    {{ svg('favorite') }}
                </div>
            @endif
        </div>
    </div>
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="interior-card-slider-thumbs owl-carousel owl-theme">--}}
{{--                    @foreach($portfolio->getImages() as $image)--}}
{{--                        <div class="interior-card-slider-thumbs-item">--}}
{{--                            <img src="{{ $image->getThumb() }}" alt="{{ $image->alt }}" data-index="{{ $loop->index }}" />--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    @include('layouts.sections.sales-leaders')
    @include('layouts.sections.why-choose-us')
@endsection

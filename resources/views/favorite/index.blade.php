@extends('layouts.app', [
    'className' => 'first-screen sub-page'
])

@section('title', 'Избранное')
@section('description', 'Избранное')
@push('og')
    <meta property="og:title" content="Избранное">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:site_name" content="Фабрика дверей и мебели">
    <meta property="og:locale" content="ru_RU">
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('page.show') }}">Главная</a></li>
                        <li>Избранное</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="favorite-list">
        @if($favoriteCollectionDto->furniture)
            <div class="container">
                <div class="row flex-start">
                    @foreach($favoriteCollectionDto->furniture as $furniture)
                        @include('layouts.partials._furniture_item', ['entity' => $entity])
                    @endforeach
                </div>
            </div>
        @endif

        @if($favoriteCollectionDto->doors)
            <div class="container">
                <div class="row flex-start">
                    @foreach($favoriteCollectionDto->doors as $door)
                        @include('layouts.partials._door_item', ['entity' => $door])
                    @endforeach
                </div>
            </div>
        @endif

        @if($favoriteCollectionDto->portfolio)
            @foreach($favoriteCollectionDto->portfolio as $portfolio)
                <section class="interior-projects">
                    @include('layouts.partials._portfolio_item', ['entity' => $portfolio])
                </section>
            @endforeach
        @endif
    </section>
@endsection

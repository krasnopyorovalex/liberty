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
        @foreach($collection as $entity)
            @switch($entity->getTable())
                @case('furniture')
                    <div class="container">
                        <div class="row flex-start">
                            @include('layouts.partials._furniture_item', ['entity' => $entity])
                        </div>
                    </div>
                @break

                @case('doors')
                    <div class="container">
                        <div class="row flex-start">
                            <div class="col-4">
                                @include('layouts.partials._door_item', ['entity' => $entity])
                            </div>
                        </div>
                    </div>
                @break

                @default
                    <section class="interior-projects">
                        @include('layouts.partials._portfolio_item', ['entity' => $entity])
                    </section>
            @endswitch
        @endforeach
    </section>
@endsection

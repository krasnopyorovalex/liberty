@extends('layouts.app', [
    'className' => 'first-screen sub-page'
])

@section('title', 'Страница поиска')
@section('description', 'Страница поиска')
@push('og')
    <meta property="og:title" content="Страница поиска">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:site_name" content="Фабрика дверей и мебели">
    <meta property="og:locale" content="ru_RU">
@endpush
@section('content')
    <div class="search-content-box{{ request()->get('keyword') ? ' height-reset' : '' }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('page.show') }}">Главная</a></li>
                            <li>Страница поиска</li>
                        </ul>
                    </div>
                    <form action="{{ route('search') }}" class="form-search" method="get">
                        <div class="form-group flex">
                            <input type="text"
                                   name="keyword"
                                   id="search-input"
                                   value="{{ request()->get('keyword')  }}"
                                   minlength="3"
                                   required
                                   placeholder="Введите поисковую фразу"
                                   autocomplete="off"
                            />
                            <button class="btn" type="submit">Найти</button>
                        </div>
                        <div class="form-search-params">
                            <div class="row flex-start">
                                <div class="col-6">
                                    <div class="form-search-params-title">Параметры для дверей</div>
                                    @foreach($doorAttributes as $doorAttribute)
                                        <div class="form-search-params-name">{{ $doorAttribute->name }}</div>
                                        @foreach($doorAttribute->doorHasAttributes->unique() as $doorHasAttribute)
                                            <label>
                                                {{ $doorHasAttribute->value }}
                                                <input type="checkbox" name="doorAttributes[]" value="{{ $doorHasAttribute->value }}" {{ in_array($doorHasAttribute->value, request('doorAttributes', [])) ? 'checked' : '' }} />
                                            </label>
                                        @endforeach
                                    @endforeach
                                </div>
                                <div class="col-6">
                                    <div class="form-search-params-title">Параметры для мебели</div>
                                    @foreach($furnitureAttributes as $furnitureAttribute)
                                        <div class="form-search-params-name">{{ $furnitureAttribute->name }}</div>
                                        @foreach($furnitureAttribute->furnitureHasAttributes->unique() as $furnitureHasAttribute)
                                            <label>
                                                {{ $furnitureHasAttribute->value }}
                                                <input type="checkbox" name="furnitureAttributes[]" value="{{ $furnitureHasAttribute->value }}" {{ in_array($furnitureHasAttribute->value, request('furnitureAttributes', [])) ? 'checked' : '' }} />
                                            </label>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <section>
                <div class="row">
                    <div class="col-12">
                        @if($searchResult->furniture && $searchResult->furniture->count())
                            <div class="category-list">
                                <div class="category-products">
                                    <div class="row">
                                        @foreach($searchResult->furniture as $furniture)
                                            @include('layouts.partials._furniture_item', ['entity' => $furniture])
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($searchResult->doors && $searchResult->doors->count())
                            <div class="doors-cards">
                                @foreach($searchResult->doors as $door)
                                    @include('layouts.partials._door_item', ['entity' => $door])
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
    <section>
        @if($searchResult->portfolios && $searchResult->portfolios->count())
            <div class="interior-projects">
                @foreach($searchResult->portfolios as $portfolio)
                    @include('layouts.partials._portfolio_item', ['entity' => $portfolio])
                @endforeach
            </div>
            <br/>
            <br/>
        @endif
    </section>
    @if(!$searchResult->furniture && request()->has('keyword'))
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="center">Ничего не найдено</p>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

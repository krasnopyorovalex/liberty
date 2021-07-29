@extends('layouts.app')

@section('title', '404 - Страница не найдена')
@section('description', '404 - Страница не найдена')
@section('keywords', '404 - Страница не найдена')

@section('content')

    <section class="not__found">
        <div class="bg__box"></div>
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <div class="not__found-box">
                        <img src="{{ asset('img/in_404.svg') }}" alt="страница не найдена">
                        <div>УПС</div>
                        <div>404</div>
                        <span>Страница не найдена</span>
                    </div>
                    <a href="{{ route('page.show') }}" class="btn_404">Перейти на главную</a>
                </div>
            </div>
        </div>
    </section>

@endsection
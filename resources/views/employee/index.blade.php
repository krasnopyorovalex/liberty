@extends('layouts.app', ['className' => ''])

@section('title', $employee->title)
@section('description', $employee->description)
@push('og')
    <meta property="og:title" content="{{ $employee->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($employee->image ? $employee->image->path : 'images/logo.png') }}">
    <meta property="og:description" content="{{ $employee->description }}">
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
                            <li>{{ $employee->name }}</li>
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
                            {{ $employee->name }}
                        </div>
                        <div class="employee-info-body-photo visible-sm">
                            @if($employee->image)
                                <img src="{{ asset($employee->image->path) }}" alt="Фото сотрудника: {{ $employee->name }}">
                            @endif
                        </div>
                        <div class="employee-info-body-text">
                            {!! $employee->text !!}
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="employee-info-body-photo hidden-sm">
                        @if($employee->image)
                            <img src="{{ asset($employee->image->path) }}" alt="Фото сотрудника: {{ $employee->name }}">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
@endsection

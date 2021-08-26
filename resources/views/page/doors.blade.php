@extends('layouts.app', ['className' => 'with-absolute-header sub-page about'])

@section('title', $page->title)
@section('description', $page->description)
@push('og')
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($page->image ? $page->image->path : 'images/logo.png') }}">
    <meta property="og:description" content="{{ $page->description }}">
    <meta property="og:site_name" content="Всё для бани">
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
@endsection

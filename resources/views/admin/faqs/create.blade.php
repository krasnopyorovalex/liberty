@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.faqs.index') }}">Faq</a></li>
    <li class="active">Форма добавления</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.faqs.store') }}" method="post">
                @csrf

                @input(['name' => 'question', 'label' => 'Вопрос'])
                @textarea(['name' => 'answer', 'label' => 'Ответ'])

                @submit_btn()
            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
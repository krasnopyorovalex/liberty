@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.faqs.index') }}">Faq</a></li>
    <li class="active">Форма редактирования</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.faqs.update', ['id' => $faq->id]) }}" method="post">
                @csrf
                @method('put')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <div class="row">
                                <div class="col-md-12">
                                    @input(['name' => 'question', 'label' => 'Вопрос', 'entity' => $faq])
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @textarea(['name' => 'answer', 'label' => 'Ответ', 'entity' => $faq])

                                    @submit_btn()
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
    @endpush
@endsection
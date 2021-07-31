@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.how_we_works.index') }}">Как мы работаем</a></li>
    <li class="active">Форма редактирования</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.how_we_works.update', ['id' => $howWeWork->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $howWeWork])
                            @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $howWeWork])
                            @submit_btn()
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

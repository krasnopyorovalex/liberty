@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.blocks.index') }}">Блоки</a></li>
    <li class="active">Форма редактирования</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.blocks.update', ['id' => $block->id]) }}" method="post">
                @csrf
                @method('put')

                @input(['name' => 'name', 'label' => 'Название', 'entity' => $block])
                @input(['name' => 'sys_name', 'label' => 'Системное имя для вывода в шаблоне', 'entity' => $block])
                @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $block])

                @submit_btn()
            </form>

        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
    @endpush
@endsection

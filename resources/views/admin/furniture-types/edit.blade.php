@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.furniture_types.index') }}">Типы мебели</a></li>
    <li class="active">Форма редактирования</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.furniture_types.update', ['id' => $furnitureType->id]) }}" method="post">
                @csrf
                @method('put')

                @input(['name' => 'name', 'label' => 'Название', 'entity' => $furnitureType])

                @submit_btn()

            </form>

        </div>
    </div>
@endsection

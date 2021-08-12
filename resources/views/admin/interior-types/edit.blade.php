@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.interior_types.index') }}">Типы портфолио</a></li>
    <li class="active">Форма редактирования</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.interior_types.update', ['id' => $interiorType->id]) }}" method="post">
                @csrf
                @method('put')

                @input(['name' => 'name', 'label' => 'Название', 'entity' => $interiorType])

                @submit_btn()

            </form>

        </div>
    </div>
@endsection

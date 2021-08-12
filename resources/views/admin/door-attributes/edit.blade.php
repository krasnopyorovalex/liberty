@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.door_attributes.index') }}">Атрибуты дверей</a></li>
    <li class="active">Форма редактирования</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.door_attributes.update', ['id' => $doorAttribute->id]) }}" method="post">
                @csrf
                @method('put')

                @input(['name' => 'name', 'label' => 'Название', 'entity' => $doorAttribute])

                @submit_btn()

            </form>

        </div>
    </div>
@endsection

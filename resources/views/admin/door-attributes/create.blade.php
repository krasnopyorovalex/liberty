@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.door_attributes.index') }}">Атрибуты дверей</a></li>
    <li class="active">Форма добавления</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.door_attributes.store') }}" method="post">
                @csrf

                @input(['name' => 'name', 'label' => 'Название'])

                @submit_btn()
            </form>

        </div>
    </div>

@endsection

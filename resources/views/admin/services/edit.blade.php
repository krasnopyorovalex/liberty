@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.services.index') }}">Услуги</a></li>
    <li class="active">Форма редактирования услуги</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования услуги</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.services.update', ['id' => $service->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                        <li><a href="#image" data-toggle="tab">Изображение</a></li>
                        <li><a href="#faqs" data-toggle="tab">Faq</a></li>
                        <li><a href="#portfolios" data-toggle="tab">Портфолио</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">

                            <div class="form-group">
                                <label for="parent_id">Выберите родительский пункт меню</label>
                                <select class="form-control border-blue border-xs select-search" id="parent_id" name="parent_id" data-width="100%">
                                    <option value="">Не выбрано</option>
                                    @foreach($services as $s)
                                        <option value="{{ $s->id }}"  @if ( $s->id == old('parent_id', $service->parent_id))selected="selected"@endif>{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="icon_id">Выберите иконку</label>
                                <select class="form-control border-blue border-xs select-icons" id="icon_id" name="icon" data-width="100%">
                                    @foreach ($service->getIcons() as $key => $value)
                                        <option value="{{ $key }}" data-icon="{{ $key }}" @if ($key == $service->icon)selected="selected"@endif>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="services">Выберите сопутствующие услуги</label>
                                <select class="form-control border-blue border-xs select-search" multiple="multiple" id="services" name="services[]" data-width="100%">
                                    @foreach($services as $item)
                                        <option value="{{ $item->id }}" {{ in_array($item->id, $relatedServices) ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @if ($item->services)
                                            @foreach ($item->services as $subItem)
                                                <option value="{{ $subItem->id }}" {{ in_array($subItem->id, $relatedServices) ? 'selected' : '' }}>*** {{ $subItem->name }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $service])
                            @input(['name' => 'slogan', 'label' => 'Слоган', 'entity' => $service])
                            @input(['name' => 'title_block', 'label' => 'Название блока для дочерних услуг', 'entity' => $service])
                            @input(['name' => 'menu_name', 'label' => 'Название в меню', 'entity' => $service])
                            @input(['name' => 'title', 'label' => 'Title', 'entity' => $service])
                            @input(['name' => 'description', 'label' => 'Description', 'entity' => $service])

                            @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $service])
                            @input(['name' => 'price', 'label' => 'Цена', 'entity' => $service])
                            @textarea(['name' => 'preview', 'label' => 'Превью услуги', 'id' => 'editor-full2', 'entity' => $service])
                            @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $service])
                            @checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'entity' => $service])
                            @checkbox(['name' => 'is_showed_dev_stages', 'label' => 'Отображать блок - Этапы разработки сайта?', 'entity' => $service])

                            @submit_btn()
                        </div>
                        <div class="tab-pane" id="image">
                            @if ($service->image)
                                <div class="panel panel-flat border-blue border-xs" id="image__box">
                                    <div class="panel-body">
                                        <img src="{{ asset($service->image->path) }}" alt="" class="upload__image">

                                        <div class="btn-group btn__actions">
                                            <button data-toggle="modal" data-target="#modal_info" type="button" class="btn btn-primary btn-labeled btn-sm"><b><i class="icon-pencil4"></i></b> Атрибуты</button>

                                            <button type="button" data-href="{{ route('admin.images.destroy', ['id' => $service->image->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $service, 'label' => 'Выберите изображение на компьютере'])
                            @submit_btn()
                        </div>

                        <div class="tab-pane" id="faqs">
                            <div class="form-group">
                                <label for="faqs">Выберите Вопрос-ответ</label>
                                <select class="form-control border-blue border-xs select-search" multiple="multiple" id="faqs" name="faqs[]" data-width="100%">
                                    @foreach($faqs as $faq)
                                        <option value="{{ $faq->id }}" {{ in_array($faq->id, $relatedFaqs) ? 'selected' : '' }}>{{ $faq->question }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @submit_btn()
                        </div>

                        <div class="tab-pane" id="portfolios">
                            <div class="form-group">
                                <label for="portfolio">Выберите портфолио</label>
                                <select class="form-control border-blue border-xs select-search" multiple="multiple" id="portfolio" name="portfolios[]" data-width="100%">
                                    @foreach($portfolios as $portfolio)
                                        <option value="{{ $portfolio->id }}" {{ in_array($portfolio->id, $relatedPortfolios) ? 'selected' : '' }}>{{ $portfolio->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
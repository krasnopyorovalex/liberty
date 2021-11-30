<div class="nav nav-pills nav-justified" id="pills-target-right-mobile">
    @foreach($furniture->imagesForMobile as $image)
        <div data-id="{{ $image->id }}" class="status_{{ $image->publish }} single_image">
            <div class="image-thumb">
                <div class="thumbnail">
                    <div class="thumb">
                        <img src="{{ $image->getPath() }}" alt="">
                        <div class="caption-overflow">
                        <span>
                            <a href="{{ route('admin.furniture_images.edit', $image) }}" data-toggle="modal" data-target="#edit-image" class="btn btn-flat border-white text-white btn-rounded btn-icon">
                                <i class="icon-pencil"></i>
                            </a>
                            <a class="btn btn-flat border-white text-white btn-rounded btn-icon" href="{{ route('admin.furniture_images.destroy', $image) }}">
                                <i class="icon-trash"></i>
                            </a>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

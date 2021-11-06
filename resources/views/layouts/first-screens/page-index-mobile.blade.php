<div class="main-slider">
    <div>
        @foreach($images->take(1) as $image)
        <div class="main-slider-item">
            <img src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}">
            <div class="main-slider-item-desc">
                <div class="visible-sm main-slider-item-desc-mob uppercase">собственное производство</div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="main-slider-nav flex">
        @foreach($images as $image)
        <div class="main-slider-nav-control">
            <span>0{{ $loop->index + 1 }}.</span>
            <span><a href="{{ $image->link }}">{{ $image->name }}</a></span>
        </div>
        @endforeach
    </div>
</div>

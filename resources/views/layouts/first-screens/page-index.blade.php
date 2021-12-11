<div class="main-slider">
    <div class="owl-carousel owl-theme">
        @foreach($images as $image)
        <div class="main-slider-item">
            <img class="owl-lazy" data-src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}">
            <div class="main-slider-item-desc">
                <p>{!! $image->text !!}</p>
\                <div class="btn-main-slider-box">
                    <a href="{{ $image->link }}" class="btn btn-main-slider-more">подробнее</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="main-slider-nav flex">
        @foreach($images as $image)
        <div class="main-slider-nav-control{{ $loop->index === 0 ? ' active' : '' }}">
            <span>0{{ $loop->index + 1 }}.</span>
            <span>{{ $image->name }}</span>
        </div>
        @endforeach
    </div>
</div>

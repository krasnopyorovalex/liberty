<div class="interior-projects-item">
    <div class="slider-projects owl-theme owl-carousel">
        @foreach($entity->getImages() as $image)
            <div class="slider-projects-item">
                <picture>
                    <img src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}">
                </picture>
            </div>
        @endforeach
    </div>
    <div class="decoration-line wow slideInLeft visible-sm"></div>
    <div class="slider-projects-desc hidden-sm">
        {!! $entity->text !!}
    </div>
    <div class="btn-box">
        <a href="{{ $entity->url }}" class="btn">смотреть проект</a>
    </div>
    <div class="interior-projects-title uppercase">
        {{ $entity->name }}
    </div>
</div>

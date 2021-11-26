<div class="interior-projects-item">
    <div class="slider-projects owl-theme owl-carousel">
        @foreach($entity->getImages()->take(5) as $image)
            <div class="slider-projects-item">
                <picture>
                    <img src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}">
                </picture>
            </div>
        @endforeach
    </div>
    @if(request()->path() === 'favorite')
    <div class="favorite-action is-favorite" data-action="{{ route('favorite.remove', $entity) }}" data-entity="{{ get_class($entity) }}">
        {{ svg('favorite-active') }}
    </div>
    @endif
    <div class="decoration-line wow slideInLeft visible-sm"></div>
    @if($entity->text)
    <div class="slider-projects-desc hidden-sm">
        {!! $entity->text !!}
    </div>
    @endif
    <div class="btn-box">
        <a href="{{ $entity->url }}" class="btn">смотреть проект</a>
    </div>
    <div class="interior-projects-title uppercase">
        {{ $entity->name }}
    </div>
</div>

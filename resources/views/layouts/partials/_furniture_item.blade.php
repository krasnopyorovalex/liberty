<div class="col-4" style="position: relative">
    <a href="{{ $entity->url }}">
        <div class="category-products-item">
            <div class="img hovered">
                <picture>
                    <source media="(max-width: 670px)" srcset="{{ $entity->image_mob }}">
                    <img src="{{ asset($entity->image) }}">
                </picture>
            </div>
            <div class="info flex">
                <div class="name">{{ $entity->name }}</div>
                <div class="price">{!! $entity->getPrice() !!}</div>
            </div>
        </div>
    </a>
    @if(request()->path() === 'favorite')
    <div class="favorite-action" data-action="{{ route('favorite.remove', $entity) }}" data-entity="{{ get_class($entity) }}">
        {{ svg('favorite-active') }}
    </div>
    @endif
</div>

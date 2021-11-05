<div class="doors-cards-item">
    <a href="{{ $entity->url }}">
        <div class="doors-cards-item-img">
            <picture>
                @if($entity->image)
                    <source media="(max-width: 670px)" srcset="{{ $entity->getMobileImage() }}">
                    <img src="{{ $entity->getDesktopImage() }}" alt="{{ $entity->name }}">
                @endif
            </picture>
            <div class="decoration-line"></div>
        </div>
        <div class="doors-cards-item-info flex">
            <div class="doors-cards-item-info-title">{{ $entity->name }}</div>
            <div class="doors-cards-item-info-cost">
                <div class="cost-value">{!! $entity->getPrice() !!}</div>
            </div>
        </div>
    </a>
    @if(request()->path() === 'favorite')
    <div class="favorite-action" data-action="{{ route('favorite.remove', $entity) }}" data-entity="{{ get_class($entity) }}">
        {{ svg('favorite-active') }}
    </div>
    @endif
</div>

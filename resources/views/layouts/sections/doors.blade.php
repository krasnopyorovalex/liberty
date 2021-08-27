<div class="doors-cards">
    @foreach($doors as $door)
        <div class="doors-cards-item">
            <a href="{{ $door->url }}">
                <div class="doors-cards-item-img">
                    <picture>
                        @if($door->image_mob)
                            <source media="(max-width: 670px)" srcset="{{ $door->image_mob }}">
                        @endif
                        @if($door->image)
                            <img src="{{ $door->image }}" alt="{{ $door->name }}">
                        @endif
                    </picture>
                    <div class="decoration-line"></div>
                </div>
                <div class="doors-cards-item-info flex">
                    <div class="doors-cards-item-info-title">{{ $door->name }}</div>
                    <div class="doors-cards-item-info-cost">
                        <div class="cost-value">{!! $door->getPrice() !!}</div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

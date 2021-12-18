@if($sliderItems->count())
<section class="premium-collections">
    <img src="img/premium-collections-bg.png" alt="alt">
    <div class="section-header">
        <div class="section-title wow slideInLeft">ИСПОЛНЕНИЕ ПРЕМИУМ КЛаССА</div>
        <div class="section-sub-title sub-title-without-bg wow slideInLeft">Коллекции современных классических
            интерьеров
        </div>
    </div>
    <div class="slider-projects owl-theme owl-carousel">
        @foreach($sliderItems as $sliderItem)
            <div class="slider-projects-item">
                <picture>
                    @if($sliderItem->image)
                        <source media="(max-width: 670px)" srcset="{{ asset($sliderItem->image_mob) }}">
                        <img src="{{ asset($sliderItem->image) }}" alt="{{ $sliderItem->name }}">
                    @endif
                </picture>
                <div class="slider-projects-item-desc">
                    <div class="decoration-line wow slideInLeft"></div>
                    <div class="title">{{ $sliderItem->name }}</div>
                    <!--                <div class="photos-count">20 фотографий</div>-->
                </div>
                <div class="btn-box">
                    <a href="{{ $sliderItem->url }}" class="btn">смотреть проект</a>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

@if($salesLeaders)
    <section class="sales-leaders">
        <div class="section-header">
            <div class="section-title wow slideInLeft">лидеры продаж</div>
            <div class="section-sub-title wow slideInLeft">
                Мелодии, которые всегда будут звучать в Вашем доме
                <div class="decoration-line"></div>
            </div>
        </div>
        @if(is_mobile())
            <div class="sales-leaders-slider-mobile visible-sm">
                <div class="owl-theme owl-carousel">
                    @foreach($salesLeaders->imagesForMobile as $image)
                        <div class="sales-leaders-slider-item">
                            <div class="sales-leaders-slider-item-img-single">
                                <img src="{{ $image->getPath() }}" alt="{{ $image->alt }}">
                                <div class="title flex">
                                    <a href="{{ $image->link }}">{{ $image->name }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="sales-leaders-slider owl-theme owl-carousel">
                @foreach($salesLeaders->images->chunk(4) as $chunks)
                    <div class="sales-leaders-slider-item flex">
                        @foreach($chunks as $image)
                            @if($loop->index === 1)
                                <div class="sales-leaders-slider-item-img-double">
                            @endif
                            <div class="sales-leaders-slider-item-img-single">
                                <img class="owl-lazy" data-src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                                <div class="decoration-line"></div>
                                <div class="title flex">
                                    <a href="{{ $image->link }}">{{ $image->name }}</a>
                                </div>
                            </div>
                            @if($loop->index === 2)
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
            <div class="center">
                <a href="{{ route('page.show', ['alias' => 'furniture']) }}" class="btn btn-more-leaders">больше проектов</a>
            </div>
        @endif
    </section>
@endif

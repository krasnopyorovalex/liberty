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
                <div class="sales-leaders-slider-item flex">
                    <div class="sales-leaders-slider-item-img-single">
                        <img src="img/sales-leaders-slider-img-01.jpg" alt="alt">
                        <div class="decoration-line"></div>
                        <div class="title flex">
                            <a href="#">коллекция «нота»</a>
                        </div>
                    </div>
                    <div class="sales-leaders-slider-item-img-double">
                        <div class="sales-leaders-slider-item-img-single">
                            <img src="img/sales-leaders-slider-img-02.jpg" alt="alt">
                            <div class="decoration-line"></div>
                            <div class="title flex">
                                <a href="#">Коллекция «Аккорд»</a>
                            </div>
                        </div>
                        <div class="sales-leaders-slider-item-img-single">
                            <img src="img/sales-leaders-slider-img-03.jpg" alt="alt">
                            <div class="decoration-line"></div>
                            <div class="title flex">
                                <a href="#">дверь межкомнатная «фламенко»</a>
                            </div>
                        </div>
                    </div>
                    <div class="sales-leaders-slider-item-img-single">
                        <img src="img/sales-leaders-slider-img-04.jpg" alt="alt">
                        <div class="decoration-line"></div>
                        <div class="title flex">
                            <a href="#">дверь межкомнатная «фламенко»</a>
                        </div>
                    </div>
                </div>
                <div class="sales-leaders-slider-item flex">
                    <div class="sales-leaders-slider-item-img-single">
                        <img src="img/sales-leaders-slider-img-01.jpg" alt="alt">
                        <div class="decoration-line"></div>
                        <div class="title flex">
                            <a href="#">коллекция «нота»</a>
                        </div>
                    </div>
                    <div class="sales-leaders-slider-item-img-double">
                        <div class="sales-leaders-slider-item-img-single">
                            <img src="img/sales-leaders-slider-img-02.jpg" alt="alt">
                            <div class="decoration-line"></div>
                            <div class="title flex">
                                <a href="#">Коллекция «Аккорд»</a>
                            </div>
                        </div>
                        <div class="sales-leaders-slider-item-img-single">
                            <img src="img/sales-leaders-slider-img-03.jpg" alt="alt">
                            <div class="decoration-line"></div>
                            <div class="title flex">
                                <a href="#">дверь межкомнатная «фламенко»</a>
                            </div>
                        </div>
                    </div>
                    <div class="sales-leaders-slider-item-img-single">
                        <img src="img/sales-leaders-slider-img-04.jpg" alt="alt">
                        <div class="decoration-line"></div>
                        <div class="title flex">
                            <a href="#">дверь межкомнатная «фламенко»</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="center">
                <a href="#" class="btn btn-more-leaders">больше проектов</a>
            </div>
        @endif
    </section>
@endif

<section class="authors">
    <div class="section-header">
        <div class="section-title wow slideInLeft">авторы проектов</div>
        <div class="section-sub-title wow slideInLeft">
            Художники и дизайнеры нашей фабрики и других дизайн-студий
            <div class="decoration-line"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="authors-slider owl-carousel owl-theme">
                    @foreach($authors as $author)
                        <div class="authors-slider-item">
                            @if($author->image)
                            <img src="{{ $author->image->path }}" alt="{{ $author->image->alt }}" title="{{ $author->image->title }}" />
                            @endif
                            <div class="author-name">{{ $author->name }}</div>
                            <div class="btn-box">
                                <div class="btn">проектов {{ $author->doors_count + $author->furniture_count + $author->interiors_count }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="about-us-box center">
                    <a href="#" class="btn">узнать больше о нас</a>
                </div>
            </div>
        </div>
    </div>
</section>

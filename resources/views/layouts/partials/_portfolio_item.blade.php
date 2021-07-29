<div class="portfolio__list-item {{ $portfolio->category }}">
    <div class="bg__item {{ $portfolio->color }}"></div>
    <div class="image__preview">
        @if($portfolio->image)
        <figure>
            <a href="{{ $portfolio->url }}">
                <img src="" data-src="{{ $portfolio->image->path }}" alt="{{ $portfolio->image->alt }}" title="{{ $portfolio->image->title }}">
            </a>
        </figure>
        @endif
    </div>
    <div class="body">
        <div class="bg__box">
            <div class="name">
                <a href="{{ $portfolio->url }}">{{ $portfolio->name }}</a>
            </div>
            <div class="desc">
                {!! $portfolio->preview !!}
            </div>
            @if ($portfolio->tags)
                <div class="tags">
                    @foreach ($portfolio->tags as $tag)
                        <span>{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
            <div class="link__more">
                <div class="link__more-text">
                    <a href="{{ $portfolio->url }}" class="btn white">ПОДРОБНЕЕ</a>
                </div>
            </div>
        </div>
    </div>
</div>

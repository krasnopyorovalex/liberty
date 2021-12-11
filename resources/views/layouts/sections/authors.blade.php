<div class="authors-slider owl-carousel owl-theme">
    @foreach($authors as $author)
        <div class="authors-slider-item">
            @if($author->image)
                <a href="{{ $author->url }}">
                    <img class="owl-lazy" data-src="{{ $author->image->path }}" alt="{{ $author->image->alt }}" title="{{ $author->image->title }}" />
                </a>
            @endif
            <a href="{{ $author->url }}" class="author-name">{{ $author->name }}</a>
            <div class="btn-box">
                <a href="{{ $author->url }}" class="btn">проектов {{ $author->doors_count + $author->furniture_count + $author->interiors_count }}</a>
            </div>
        </div>
    @endforeach
</div>

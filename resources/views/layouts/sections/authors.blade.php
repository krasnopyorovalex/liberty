<div class="authors-slider owl-carousel owl-theme">
    @foreach($authors as $author)
        <div class="authors-slider-item">
            @if($author->image)
                <a href="{{ $author->url }}">
                    <img src="{{ $author->image->path }}" alt="{{ $author->image->alt }}" title="{{ $author->image->title }}" />
                </a>
            @endif
            <a href="{{ $author->url }}" class="author-name">{{ $author->name }}</a>
            <div class="btn-box">
                <div class="btn">проектов {{ $author->doors_count + $author->furniture_count + $author->interiors_count }}</div>
            </div>
        </div>
    @endforeach
</div>

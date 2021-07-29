<section class="header">
    <div class="bg__box"></div>
    <div class="container">
        <div class="row">
            <div class="body col-12 blue">
                <div class="row">
                    <div class="col-7">
                        <div class="text">
                            <h1>{{ $page->name }}</h1>
                            <p>{!! $page->slogan !!}</p>
                        </div>
                    </div>
                    <div class="col-5 hidden__xs">
                        @if($page->image)
                        <figure>
                            <img src="{{ asset($page->image->path) }}" alt="{{ $page->image->alt }}" title="{{ $page->image->title }}">
                        </figure>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul itemscope="" itemtype="http://schema.org/BreadcrumbList">
                    <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                        <a href="{{ route('page.show') }}">Главная</a>
                        <meta itemprop="position" content="1">
                    </li>
                    @if (isset($parent) && $parent)
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                            <a href="{{ route('page.show', ['alias' => $parent]) }}">{{ $name }}</a>
                            <meta itemprop="position" content="2">
                        </li>
                    @endif
                    <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                        {{ $page->menu_name ?: $page->name }}
                        <meta itemprop="position" content="{{ isset($parent) ? 3 : 2 }}">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

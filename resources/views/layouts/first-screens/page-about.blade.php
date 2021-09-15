<picture>
    @if($page->image_mob)
        <source media="(max-width: 670px)" srcset="{{ asset($page->image_mob) }}">
    @endif
    @if($page->image)
        <img src="{{ asset($page->image->path) }}">
    @endif
</picture>
<div class="about-text-first-screen">
    <h1 class="uppercase">{{ $page->name }}</h1>
    <div class="btn-box">
        <div class="btn recall-me call-popup" data-target="popup-recall-me">Заказать звонок</div>
    </div>
</div>

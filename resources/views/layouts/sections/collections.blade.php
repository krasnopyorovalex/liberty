 <section>
     @foreach($collections as $collection)
        <div class="collection-full-item">
            <img src="{{ change_image_desktop_mob($collection) }}" alt="{{ $collection->name }}" />
            <div class="info">
                <div class="title uppercase">{{ strip_tags($collection->name) }}</div>
                <div class="text">{{ strip_tags($collection->text) }}</div>
                <div class="btn-box">
                    <a href="{{ $collection->url }}" class="btn uppercase">смотреть коллекцию</a>
                </div>
            </div>
            @if($collection->catalog_file)
            <div class="download uppercase">
                <a href="{{ $collection->catalog_file }}" target="_blank">Скачать каталог коллекции</a>
                <div class="decoration-line wow slideInLeft"></div>
            </div>
            @endif
        </div>
     @endforeach
</section>

<section class="category-list">
    <div class="category-list">
        <div class="container-full">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="row category-list-items flex">
                        @foreach($collections as $collection)
                            <div class="col-4">
                                <a href="{{ $collection->url }}" class="title hovered">{{ $collection->name }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </div>

        <section class="category-products">
            <div class="container-full">
                <div class="row flex-start">
                    <div class="col-2">
                        <ul class="types-list">
                            @foreach($furnitureTypes as $furnitureType)
                                <li class="types-list-item active">
                                    <a href="{{ request()->fullUrlWithQuery(['type' => $furnitureType->id]) }}">{{ $furnitureType->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            @foreach($furnitureList as $furniture)
                            <div class="col-4">
                                <div class="category-products-item">
                                    <div class="img hovered">
                                        <picture>
                                            <source media="(max-width: 670px)" srcset="../img/product-img-1-mob.jpg">
                                            <img src="../img/product-img-1.jpg">
                                        </picture>
                                    </div>
                                    <div class="info flex">
                                        <div class="name">{{ $furniture->name }}</div>
                                        <div class="price">{!! $furniture->getPrice() !!}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{ $furnitureList->links() }}
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </section>

    </div>
</section>

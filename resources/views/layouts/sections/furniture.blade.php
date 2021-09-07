<section class="category-list">
    <div class="category-list">
        <div class="container-full">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="row category-list-items flex">
                        @foreach($collections as $collection)
                            <div class="col-4">
                                <a href="{{ $collection->url }}" class="title hovered{{ request()->url() === $collection->url ? ' active' : '' }}">{{ strip_tags($collection->name) }}</a>
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
                                <li class="types-list-item{{ request()->get('type') == $furnitureType->id ? ' active' : '' }}">
                                    <a href="{{ request()->url() }}?type={{ $furnitureType->id }}">{{ $furnitureType->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            @foreach($furnitureList as $furniture)
                                @include('layouts.partials._furniture_item', ['entity' => $furniture])
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

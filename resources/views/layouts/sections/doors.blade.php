<div class="doors-cards">
    @foreach($doors as $door)
        @include('layouts.partials._door_item', ['entity' => $door])
    @endforeach
</div>

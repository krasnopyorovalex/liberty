@if($forClients->count())
<div class="accordion">
    @foreach($forClients as $forClient)
        <div class="accordion-title uppercase{{ $loop->index === 0 ? ' active' : '' }}">
            {{ $forClient->name }}
            <span></span>
            <div class="decoration-line wow slideInLeft"></div>
        </div>
        <div class="accordion-info">
            {!! $forClient->text !!}
        </div>
    @endforeach
</div>
@endif

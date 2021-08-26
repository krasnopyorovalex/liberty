<section class="about-company">
    @foreach($aboutBlocks as $aboutBlock)
    <div class="step-item" style="background-image: url('{{ change_image_desktop_mob($aboutBlock) }}')">
        <div class="step-item-info">
            <div class="step-item-info-title flex">
                <span>0{{ $loop->index + 1 }}. </span>
                <span>{!! $aboutBlock->name !!}</span>
            </div>
            <div class="step-item-info-desc">
                {!! $aboutBlock->text !!}
            </div>
        </div>
    </div>
    @endforeach
</section>

<section class="why-choose-us">
    <div class="section-header">
        <div class="section-title"><span>почему</span> выбирают нас</div>
        <div class="section-sub-title sub-title-without-bg">Предметы мебели, которые передаются из поколения в поколение</div>
    </div>
    <div class="why-choose-us-slider owl-carousel owl-theme">
        @foreach($whyChooseUs as $item)
            <div class="step-item" style="background-image: url('{{ $item->image }}')">
                <div class="step-item-info">
                    <div class="step-item-info-title">
                        <span>0{{ $loop->index + 1 }}. </span>
                        <span>{{ $item->name }}</span>
                    </div>
                    <div class="step-item-info-desc">
                        {!! $item->text !!}
                    </div>
                    <div class="btn-box">
                        <div class="btn btn-ask-question call-popup" data-target="popup-recall-me">Задать вопрос</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

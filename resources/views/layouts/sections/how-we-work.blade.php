<section class="how-we-work">
    <div class="section-header">
        <div class="section-title wow slideInLeft">как мы работаем</div>
        <div class="section-sub-title wow slideInLeft">
            Предметы, которые передаются из поколения в поколение
            <div class="decoration-line"></div>
        </div>
    </div>
    <div class="container">
        <div class="section-body">
            <div class="row flex-start">
                @foreach($howWeWorks as $howWeWork)
                    <div class="col-4">
                        <div class="how-we-work-item">
                            <div class="how-we-work-item-desc">
                                <div class="how-we-work-item-desc-number wow fadeIn" data-wow-delay="{{ ($loop->index + 1) / 2 }}s">{{ $loop->index + 1 }}</div>
                                <div class="how-we-work-item-desc-title">{{ $howWeWork->name }}</div>
                                {!! $howWeWork->text !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

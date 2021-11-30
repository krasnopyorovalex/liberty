@if($employees->count())
<div class="section-header">
    <div class="section-sub-title uppercase">
        Сотрудники компании
        <div class="decoration-line wow slideInLeft"></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="page-about">
                <div class="authors-slider owl-carousel owl-theme employee-slider">
                    @foreach($employees as $employee)
                        <div class="authors-slider-item">
                            @if($employee->image)
                                <img src="{{ $employee->image->path }}" alt="{{ $employee->image->alt }}" title="{{ $employee->image->title }}" />
                            @endif
                            <a href="{{ $employee->url }}" class="author-name">{{ $employee->name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

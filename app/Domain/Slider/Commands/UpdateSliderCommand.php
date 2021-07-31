<?php

declare(strict_types=1);

namespace Domain\Slider\Commands;

use Domain\Slider\Queries\GetSliderByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateSliderCommand
 * @package Domain\Slider\Commands
 */
class UpdateSliderCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateSliderCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $slider = $this->dispatch(new GetSliderByIdQuery($this->id));

        return $slider->update($this->request->validated());
    }

}

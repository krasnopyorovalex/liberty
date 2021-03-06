<?php

declare(strict_types=1);

namespace Domain\SliderImage\Commands;

use Domain\SliderImage\Queries\GetSliderImageByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateSliderImageCommand
 * @package Domain\SliderImage\Commands
 */
class UpdateSliderImageCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateSliderImageCommand constructor.
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
        $image = $this->dispatch(new GetSliderImageByIdQuery($this->id));

        return $image->update($this->request->validated());
    }

}

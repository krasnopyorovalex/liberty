<?php

declare(strict_types=1);

namespace Domain\Slider\Commands;

use App\Models\Slider;
use App\Http\Requests\Request;

/**
 * Class CreateSliderCommand
 * @package Domain\Slider\Commands
 */
class CreateSliderCommand
{
    private Request $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $slider = new Slider();
        $slider->fill($this->request->validated());

        return $slider->save();
    }

}

<?php

declare(strict_types=1);

namespace Domain\DoorInteriorSliderImage\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateDoorInteriorSliderImageRequest
 * @package Domain\DoorInteriorSliderImage\Requests
 */
class UpdateDoorInteriorSliderImageRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'string|max:255|nullable',
            'alt' => 'string|max:255|nullable',
            'title' => 'string|max:255|nullable',
            'text' => 'string|nullable',
        ];
    }
}

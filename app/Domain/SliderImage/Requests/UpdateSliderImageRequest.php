<?php

declare(strict_types=1);

namespace Domain\SliderImage\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateSliderImageRequest
 * @package Domain\SliderImage\Requests
 */
class UpdateSliderImageRequest extends Request
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

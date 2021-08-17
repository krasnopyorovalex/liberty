<?php

declare(strict_types=1);

namespace Domain\FurnitureInteriorSliderImage\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateFurnitureInteriorSliderImageRequest
 * @package Domain\FurnitureInteriorSliderImage\Requests
 */
class UpdateFurnitureInteriorSliderImageRequest extends Request
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

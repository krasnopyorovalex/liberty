<?php

declare(strict_types=1);

namespace Domain\FurnitureImage\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateFurnitureImageRequest
 * @package Domain\FurnitureImage\Requests
 */
class UpdateFurnitureImageRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'string|max:255|nullable',
            'alt' => 'string|max:255|nullable',
            'title' => 'string|max:255|nullable',
            'link' => 'string|nullable',
            'text' => 'string|nullable'
        ];
    }
}

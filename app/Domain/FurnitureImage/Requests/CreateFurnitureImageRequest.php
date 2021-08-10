<?php

declare(strict_types=1);

namespace Domain\FurnitureImage\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateFurnitureImageRequest
 * @package Domain\FurnitureImage\Requests
 */
class CreateFurnitureImageRequest extends Request
{
    public function rules(): array
    {
        return [
            'upload' => 'image',
            'FurnitureImageId' => 'integer',
            'text' => 'string|nullable'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'upload.image' => 'Разрешено загружать только изображения',
            'FurnitureImageId.integer' => 'Поле «id» должно быть целым числом'
        ];
    }
}

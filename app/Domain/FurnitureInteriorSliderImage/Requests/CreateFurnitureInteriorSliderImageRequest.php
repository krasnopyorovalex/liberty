<?php

declare(strict_types=1);

namespace Domain\FurnitureInteriorSliderImage\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateFurnitureInteriorSliderImageRequest
 * @package Domain\FurnitureInteriorSliderImage\Requests
 */
class CreateFurnitureInteriorSliderImageRequest extends Request
{
    public function rules(): array
    {
        return [
            'upload' => 'image',
            'sliderId' => 'integer',
            'is_mobile' => 'digits_between:0,1',
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
            'sliderId.integer' => 'Поле «id слайдера» должно быть целым числом'
        ];
    }
}

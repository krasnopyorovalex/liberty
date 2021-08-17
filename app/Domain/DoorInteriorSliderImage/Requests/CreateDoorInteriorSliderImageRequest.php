<?php

declare(strict_types=1);

namespace Domain\DoorInteriorSliderImage\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateDoorInteriorSliderImageRequest
 * @package Domain\DoorInteriorSliderImage\Requests
 */
class CreateDoorInteriorSliderImageRequest extends Request
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

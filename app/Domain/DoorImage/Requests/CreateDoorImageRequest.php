<?php

declare(strict_types=1);

namespace Domain\DoorImage\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateDoorImageRequest
 * @package Domain\DoorImage\Requests
 */
class CreateDoorImageRequest extends Request
{
    public function rules(): array
    {
        return [
            'upload' => 'image',
            'doorImageId' => 'integer',
            'text' => 'string|nullable',
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
            'DoorImageId.integer' => 'Поле «id» должно быть целым числом'
        ];
    }
}

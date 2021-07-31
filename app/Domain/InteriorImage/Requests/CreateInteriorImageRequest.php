<?php

declare(strict_types=1);

namespace Domain\InteriorImage\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateInteriorImageRequest
 * @package Domain\InteriorImage\Requests
 */
class CreateInteriorImageRequest extends Request
{
    public function rules(): array
    {
        return [
            'upload' => 'image',
            'interiorImageId' => 'integer',
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
            'interiorImageId.integer' => 'Поле «id» должно быть целым числом'
        ];
    }
}

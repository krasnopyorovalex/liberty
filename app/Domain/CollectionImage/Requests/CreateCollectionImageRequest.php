<?php

declare(strict_types=1);

namespace Domain\CollectionImage\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateCollectionImageRequest
 * @package Domain\CollectionImage\Requests
 */
class CreateCollectionImageRequest extends Request
{
    public function rules(): array
    {
        return [
            'upload' => 'image',
            'CollectionImageId' => 'integer',
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
            'CollectionImageId.integer' => 'Поле «id» должно быть целым числом'
        ];
    }
}

<?php

declare(strict_types=1);

namespace Domain\AboutBlock\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateAboutBlockRequest
 * @package Domain\AboutBlock\Requests
 */
class UpdateAboutBlockRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'text' => 'string|required',
            'image' => 'image|nullable',
            'image_mob' => 'image|nullable'
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
            'name.required' => 'Поле «Название» обязательно для заполнения'
        ];
    }
}

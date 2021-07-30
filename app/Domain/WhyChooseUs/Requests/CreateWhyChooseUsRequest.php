<?php

declare(strict_types=1);

namespace Domain\WhyChooseUs\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateWhyChooseUsRequest
 * @package Domain\WhyChooseUs\Requests
 */
class CreateWhyChooseUsRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'text' => 'string|nullable',
            'image' => 'image|nullable',
            'image_mob' => 'image|nullable',
            'video' => 'string|nullable'
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

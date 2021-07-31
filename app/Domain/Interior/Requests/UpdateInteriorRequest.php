<?php

declare(strict_types=1);

namespace Domain\Interior\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdateInteriorRequest
 * @package Domain\Interior\Requests
 */
class UpdateInteriorRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'sub_title' => 'string|max:255|nullable',
            'title' => 'required|string|max:512',
            'description' => 'string|max:512',
            'text' => 'string|nullable',
            'is_favorite' => 'digits_between:0,1',
            'image' => 'image|nullable',
            'image_mob' => 'image|nullable',
            'alias' => [
                'required',
                'max:64',
                Rule::unique('interiors')->ignore($this->id)
            ]
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
            'name.required' => 'Поле «Название» обязательно для заполнения',
            'title.required' => 'Поле «Title» обязательно для заполнения',
            'alias.required' => 'Поле «Alias» обязательно для заполнения',
            'alias.unique' => 'Значение поля «Alias» уже присутствует в базе данных',
        ];
    }
}

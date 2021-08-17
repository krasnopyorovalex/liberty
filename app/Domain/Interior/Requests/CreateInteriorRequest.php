<?php

declare(strict_types=1);

namespace Domain\Interior\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateInteriorRequest
 * @package Domain\Interior\Requests
 */
class CreateInteriorRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'sub_title' => 'string|max:255|nullable',
            'title' => 'required|string|max:512',
            'description' => 'string|max:512',
            'text' => 'string|nullable',
            'alias' => 'required|max:64|unique:interiors',
            'image' => 'image|nullable',
            'image_mob' => 'image|nullable',
            'interior_type_id' => 'required|integer|exists:interior_types,id',
            'is_favorite' => 'digits_between:0,1',
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

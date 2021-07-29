<?php

declare(strict_types=1);

namespace Domain\Page\Requests;

use App\Http\Requests\Request;

/**
 * Class CreatePageRequest
 * @package Domain\Page\Requests
 */
class CreatePageRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'template' => 'required|string|max:24',
            'slogan' => 'string|max:255|nullable',
            'title' => 'required|string|max:512',
            'description' => 'string|max:512',
            'text' => 'string|nullable',
            'alias' => 'required|max:64|unique:pages',
            'is_published' => 'digits_between:0,1',
            'image' => 'image'
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

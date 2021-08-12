<?php

declare(strict_types=1);

namespace Domain\Door\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateDoorRequest
 * @package Domain\Door\Requests
 */
class CreateDoorRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'sub_title' => 'string|max:255|nullable',
            'title' => 'required|string|max:512',
            'description' => 'string|max:512',
            'text' => 'string|nullable',
            'alias' => 'required|max:64|unique:doors',
            'image' => 'image|nullable',
            'image_mob' => 'image|nullable',
            'doorAttributes.*' => 'string|nullable',
            'doorAttributes' => 'array|nullable',
            'author_id' => 'required|integer|exists:authors,id',
            'parent_id' => 'nullable|integer|exists:doors,id',
            'file' => 'file|nullable',
            'finishing_options.*' => 'string|nullable',
            'finishing_options' => 'array|nullable',
            'finishing_option_names.*' => 'string|nullable',
            'finishing_option_names' => 'array|nullable',
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
            'author_id.required' => 'Необходимо выбрать автора мебели'
        ];
    }
}

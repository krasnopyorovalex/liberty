<?php

declare(strict_types=1);

namespace Domain\Page\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdatePageRequest
 * @package Domain\Page\Requests
 */
class UpdatePageRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'sub_title' => 'string|max:255|nullable',
            'template' => 'required|string|max:24',
            'title' => 'required|string|max:512',
            'description' => 'string|max:512',
            'text' => 'string|nullable',
            'is_published' => 'digits_between:0,1',
            'image' => 'image|nullable',
            'imageAlt' => 'string|max:255',
            'imageTitle' => 'string|max:255',
            'slider_id' => 'nullable|integer|exists:sliders,id',
            'image_mob' => 'image|nullable',
            'alias' => [
                'required',
                'max:64',
                Rule::unique('pages')->ignore($this->id)
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

<?php

declare(strict_types=1);

namespace Domain\ForClient\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateForClientRequest
 * @package Domain\ForClient\Requests
 */
class CreateForClientRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|max:512',
            'text' => 'required|string'
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
            'text.required'  => 'Поле «Текст» обязательно для заполнения',
        ];
    }
}

<?php

declare(strict_types=1);

namespace Domain\Contact\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateContactRequest
 * @package Domain\Contact\Requests
 */
class CreateContactRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:255',
            'map' => 'required|string|max:255',
            'text' => 'required|string',
            'is_fabric' => 'digits_between:0,1',
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
        ];
    }
}

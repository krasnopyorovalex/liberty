<?php

declare(strict_types=1);

namespace Domain\HowWeWork\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateHowWeWorkRequest
 * @package Domain\HowWeWork\Requests
 */
class CreateHowWeWorkRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'text' => 'string|nullable'
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

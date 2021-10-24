<?php

declare(strict_types=1);

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;

class SearchRequest extends Request
{
    public function rules(): array
    {
        return [
            'keyword' => 'nullable|string|min:3',
            'doorAttributes' => 'nullable|array',
            'furnitureAttributes' => 'nullable|array',
            'doorAttributes.*' => 'nullable|string',
            'furnitureAttributes.*' => 'nullable|string',
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
            'keyword.required' => 'Поле «Имя» обязательно для заполнения'
        ];
    }
}

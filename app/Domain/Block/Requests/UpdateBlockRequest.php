<?php

declare(strict_types=1);

namespace Domain\Block\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdateBlockRequest
 * @package Domain\Block\Requests
 */
class UpdateBlockRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:255',
            'text' => 'string|required',
            'sys_name' => [
                'required',
                'string',
                'max:32',
                Rule::unique('blocks')->ignore($this->id)
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
            'name.required' => 'Поле «Название» обязательно для заполнения'
        ];
    }
}

<?php

declare(strict_types=1);

namespace Domain\DoorInteriorSlider\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateDoorInteriorSliderRequest
 * @package Domain\Page\Requests
 */
class UpdateDoorInteriorSliderRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512'
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

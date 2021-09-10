<?php

declare(strict_types=1);

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;
use App\Rules\NotUrl;
use App\Rules\Recaptcha2;

class GuestbookRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:20',
            'text' => ['required', 'string', new NotUrl],
            'agree' => 'accepted',
            //'g-recaptcha-response' => ['required', new Recaptcha2]
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
            'name.required' => 'Поле «Имя» обязательно для заполнения',
            'text.required' => 'Поле «Текст отзыва» обязательно для заполнения',
            'agree.accepted' => 'Необходимо дать согласие об обработке персональных данных',
            'g-recaptcha-response.required' => 'Отметьте, пожалуйста, google captcha\'у'
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;
use App\Rules\Recaptcha2;

class RecallRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:20',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
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
            'email.required' => 'Поле «E-mail» обязательно для заполнения',
            'phone.required' => 'Поле «Телефон» обязательно для заполнения',
            'file.required' => 'Необходимо прикрепить файл',
            'agree.accepted' => 'Необходимо дать согласие об обработке персональных данных',
            'g-recaptcha-response.required' => 'Отметьте, пожалуйста, google captcha\'у'
        ];
    }
}

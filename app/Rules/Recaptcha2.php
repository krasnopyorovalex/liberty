<?php

declare(strict_types=1);

namespace App\Rules;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Validation\Rule;

class Recaptcha2 implements Rule
{
    /**
     * @throws GuzzleException
     */
    public function passes($attribute, $value): bool
    {
        $client = new Client([
            'base_uri' => 'https://google.com/recaptcha/api/'
        ]);

        $response = $client->post('siteverify', [
            'query' => [
                'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
                'response' => $value
            ]
        ]);

        return json_decode((string)$response->getBody())->success;
    }

    public function message(): string
    {
        return 'Google ReCaptcha не прошла валидацию.';
    }
}

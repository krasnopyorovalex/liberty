<?php

declare(strict_types=1);

namespace App\Http\Requests;

class FileRequest extends Request
{
    public function rules(): array
    {
        return [
            'file' => ['required', 'string']
        ];
    }
}

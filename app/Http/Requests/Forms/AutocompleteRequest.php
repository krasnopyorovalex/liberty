<?php

declare(strict_types=1);

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;

class AutocompleteRequest extends Request
{
    public function rules(): array
    {
        return [
            'value' => 'required|string|min:1'
        ];
    }
}

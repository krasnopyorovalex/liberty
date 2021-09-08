<?php

declare(strict_types=1);

namespace Domain\Favorite\Requests;

use App\Http\Requests\Request;
use App\Models\Door;
use App\Models\Furniture;
use App\Models\Interior;
use Illuminate\Validation\Rule;

class FavoriteRequest extends Request
{
    public function rules(): array
    {
        return [
            'entity' => [
                'required',
                'string',
                Rule::in([Furniture::class, Door::class, Interior::class])
            ]
        ];
    }
}

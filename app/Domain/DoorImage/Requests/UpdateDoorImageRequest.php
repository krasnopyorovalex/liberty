<?php

declare(strict_types=1);

namespace Domain\DoorImage\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateDoorImageRequest
 * @package Domain\DoorImage\Requests
 */
class UpdateDoorImageRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'string|max:255|nullable',
            'alt' => 'string|max:255|nullable',
            'title' => 'string|max:255|nullable',
            'text' => 'string|nullable'
        ];
    }
}

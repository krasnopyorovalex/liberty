<?php

namespace Domain\InteriorImage\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateInteriorImageRequest
 * @package Domain\InteriorImage\Requests
 */
class UpdateInteriorImageRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'string|max:255|nullable',
            'alt' => 'string|max:255|nullable',
            'title' => 'string|max:255|nullable',
            'text' => 'string|nullable',
            'link' => 'string|nullable',
        ];
    }
}

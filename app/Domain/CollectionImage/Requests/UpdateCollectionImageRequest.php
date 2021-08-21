<?php

declare(strict_types=1);

namespace Domain\CollectionImage\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateCollectionImageRequest
 * @package Domain\CollectionImage\Requests
 */
class UpdateCollectionImageRequest extends Request
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

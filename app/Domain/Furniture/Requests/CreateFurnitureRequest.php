<?php

declare(strict_types=1);

namespace Domain\Furniture\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateFurnitureRequest
 * @package Domain\Furniture\Requests
 */
class CreateFurnitureRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'sub_title' => 'string|max:255|nullable',
            'title' => 'required|string|max:512',
            'description' => 'string|max:512',
            'text' => 'string|nullable',
            'alias' => 'required|max:64|unique:furniture',
            'image' => 'image|nullable',
            'image_mob' => 'image|nullable',
            'furnitureAttributes.*' => 'string|nullable',
            'furnitureAttributes' => 'array|nullable',
            'finishing_options.*' => 'string|nullable',
            'finishing_options' => 'array|nullable',
            'collection_id' => 'required|integer|exists:collections,id',
            'author_id' => 'required|integer|exists:authors,id',
            'furniture_type_id' => 'required|integer|exists:furniture_types,id',
            'file' => 'file|nullable',
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
            'title.required' => 'Поле «Title» обязательно для заполнения',
            'alias.required' => 'Поле «Alias» обязательно для заполнения',
            'alias.unique' => 'Значение поля «Alias» уже присутствует в базе данных',
            'author_id.required' => 'Необходимо выбрать автора мебели',
            'collection_id.required' => 'Необходимо выбрать коллекцию, к которой относится мебель'
        ];
    }
}

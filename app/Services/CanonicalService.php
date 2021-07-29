<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CanonicalService
 * @package App\Services
 */
final class CanonicalService
{
    /**
     * @param Model $entity
     * @return Model
     */
    public function check(Model $entity): Model
    {
        $numberPage = intval(request('page'));

        if ($numberPage) {
            $entity->title .= " - Страница {$numberPage}";
            $entity->description .= " - Страница {$numberPage}";
        }

        return $entity;
    }

}

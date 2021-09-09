<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Door;
use App\Models\Furniture;
use App\Models\Interior;
use App\Models\Page;
use Illuminate\Support\Str;

/**
 * Class LinkGeneratorService
 * @package App\Services
 */
final class LinkGeneratorService
{
    /**
     * @var array
     */
    private array $models = [
        Page::class => 'Страницы',
        Door::class => 'Двери',
        Furniture::class => 'Мебель',
        Interior::class => 'Портфолио'
    ];

    /**
     * @var array
     */
    private array $result = [];

    /**
     * @return array
     */
    public function getCollection(): array
    {
        foreach ($this->models as $key => $value) {

            try {
                $reflectionClass = (new \ReflectionClass($key))->newInstance();
                $module = Str::lower(class_basename($reflectionClass));
                $collection = $reflectionClass::get();

                $this->result[$value] = [
                    'module' => $module,
                    'collections' => $collection
                ];
            } catch (\Exception $exception) {
                \Log::error($exception->getMessage());
            }
        }

        return $this->result;
    }

    /**
     * @param string $modelName
     * @param string $alias
     * @return string
     */
    public function createLink(string $modelName, string $alias): string
    {
        $route = route($modelName . '.show', ['alias' => $alias], false);

        return str_replace(['index'], '', $route);
    }
}

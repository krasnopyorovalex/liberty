<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class TextParserService
 * @package App\Services
 */
final class TextParserService
{
    use DispatchesJobs;

    /**
     * @param Model $entity
     * @return string|string[]|null
     */
    public function parse(Model $entity)
    {
        return preg_replace_callback_array(
            [
                '#(<p(.*)>)?{faq}(<\/p>)?#' => static function () use ($entity) {
                    return view('layouts.shortcodes.faqs', ['faqs' => $entity->relatedFaqs]);
                }
            ],
            $entity->text
        );
    }

}

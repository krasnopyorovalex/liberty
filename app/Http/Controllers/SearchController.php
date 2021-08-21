<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\CanonicalService;

class SearchController extends Controller
{
    /**
     * @var CanonicalService
     */
    protected CanonicalService $canonicalService;

    /**
     * @param CanonicalService $canonicalService
     */
    public function __construct(CanonicalService $canonicalService)
    {
        $this->canonicalService = $canonicalService;
    }

    public function __invoke()
    {
       return [new \stdClass()];
    }
}

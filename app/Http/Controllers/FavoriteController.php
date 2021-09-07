<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Forms\AutocompleteRequest;
use App\Services\CanonicalService;
use Domain\Autocomplete\Queries\AutocompleteQuery;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

class FavoriteController extends Controller
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

    /**
     * @param AutocompleteRequest $request
     * @return JsonResponse
     */
    public function __invoke(AutocompleteRequest $request): JsonResponse
    {
        $result = $this->dispatch(new AutocompleteQuery($request));

        return response()->json($result);
    }
}

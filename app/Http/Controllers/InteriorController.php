<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Services\CanonicalService;
use Domain\Interior\Queries\GetInteriorByAliasQuery;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Exception;

class InteriorController extends Controller
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
     * @param string $alias
     * @return Factory|View
     */
    public function __invoke(string $alias)
    {
        $interior = $this->dispatch(new GetInteriorByAliasQuery($alias));

        try {
            /** @var $interior Collection */
            $interior = $this->canonicalService->check($interior);
        } catch (Exception $exception) {
            $interior->text = $exception->getMessage();
        }

        return view('interior.index', ['interior' => $interior]);
    }
}

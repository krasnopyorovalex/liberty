<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasFavorites;
use App\Models\Collection;
use App\Models\Interior;
use App\Services\CanonicalService;
use Domain\Interior\Queries\GetInteriorByAliasQuery;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Exception;

class InteriorController extends Controller
{
    use HasFavorites;

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
        $portfolio = $this->dispatch(new GetInteriorByAliasQuery($alias));

        try {
            /** @var $portfolio Collection */
            $portfolio = $this->canonicalService->check($portfolio);
        } catch (Exception $exception) {
            $portfolio->text = $exception->getMessage();
        }

        return view('portfolio.index', [
            'portfolio' => $portfolio,
            'isFavorite' => $this->isFavorite($portfolio->id, Interior::class)
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Collection;
use Domain\Collection\Queries\GetCollectionByAliasQuery;
use App\Services\CanonicalService;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Exception;

/**
 * Class AuthorController
 * @package App\Http\Controllers
 */
class CollectionController extends Controller
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
        /** @var $collection Collection */
        $collection = $this->dispatch(new GetCollectionByAliasQuery($alias));

        try {
            /** @var $collection Collection */
            $collection = $this->canonicalService->check($collection);
        } catch (Exception $exception) {
            $collection->text = $exception->getMessage();
        }

        return view('collections.index', ['collection' => $collection]);
    }
}

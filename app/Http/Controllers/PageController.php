<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Page\Queries\GetPageByAliasQuery;
use App\Models\Page;
use App\Services\CanonicalService;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Exception;

/**
 * Class PageController
 * @package App\Http\Controllers
 */
class PageController extends Controller
{
    /**
     * @var CanonicalService
     */
    protected CanonicalService $canonicalService;

    public function __construct(CanonicalService $canonicalService)
    {
        $this->canonicalService = $canonicalService;
    }

    /**
     * @param string $alias
     * @return Factory|View
     */
    public function __invoke(string $alias = 'index')
    {
        /** @var $page Page*/
        $page = $this->dispatch(new GetPageByAliasQuery($alias));

        try {
            /** @var $page Page*/
            $page = $this->canonicalService->check($page);
        } catch (Exception $exception) {
            $page->text = $exception->getMessage();
        }

        return view($page->template, ['page' => $page]);
    }
}

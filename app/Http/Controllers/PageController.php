<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Page\Queries\GetPageByAliasQuery;
use App\Models\Page;
use App\Services\CanonicalService;
use App\Services\TextParserService;
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
    protected $canonicalService;

    /**
     * @var TextParserService
     */
    protected $parserService;

    /**
     * PageController constructor.
     * @param TextParserService $parserService
     * @param CanonicalService $canonicalService
     */
    public function __construct(TextParserService $parserService, CanonicalService $canonicalService)
    {
        $this->canonicalService = $canonicalService;
        $this->parserService = $parserService;
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
            $page->text = $this->parserService->parse($page);

        } catch (Exception $exception) {
            $page->text = $exception->getMessage();
        }

        return view($page->template, ['page' => $page]);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Author;
use Domain\Author\Queries\GetAuthorByAliasQuery;
use App\Services\CanonicalService;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Exception;

/**
 * Class AuthorController
 * @package App\Http\Controllers
 */
class AuthorController extends Controller
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
        /** @var $author Author*/
        $author = $this->dispatch(new GetAuthorByAliasQuery($alias));

        try {
            /** @var $author Author*/
            $author = $this->canonicalService->check($author);

        } catch (Exception $exception) {
            $author->text = $exception->getMessage();
        }

        return view('authors.index', ['author' => $author]);
    }
}

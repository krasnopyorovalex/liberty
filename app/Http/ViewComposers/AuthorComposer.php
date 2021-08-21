<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\Author\Queries\GetAllAuthorsWithCountRelationsQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class AuthorComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $authors */
        $authors = $this->dispatch(new GetAllAuthorsWithCountRelationsQuery());

        $view->with('authors', $authors);
    }
}

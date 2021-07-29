<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Domain\Page\Commands\CreatePageCommand;
use App\Domain\Page\Commands\DeletePageCommand;
use App\Domain\Page\Commands\UpdatePageCommand;
use App\Domain\Page\Queries\GetAllPagesQuery;
use App\Domain\Page\Queries\GetPageByIdQuery;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Domain\Page\Requests\CreatePageRequest;
use Domain\Page\Requests\UpdatePageRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class PageController
 * @package App\Http\Controllers\Admin
 */
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $pages = $this->dispatch(new GetAllPagesQuery);

        return view('admin.pages.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $page = new Page();

        return view('admin.pages.create', [
            'templates' => $page->getTemplates()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePageRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreatePageRequest $request)
    {
        $this->dispatch(new CreatePageCommand($request));

        return redirect(route('admin.pages.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $page = $this->dispatch(new GetPageByIdQuery($id));

        return view('admin.pages.edit', [
            'page' => $page
        ]);
    }

    /**
     * @param int $id
     * @param UpdatePageRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, UpdatePageRequest $request)
    {
        $this->dispatch(new UpdatePageCommand($id, $request));

        return redirect(route('admin.pages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeletePageCommand($id));

        return redirect(route('admin.pages.index'));
    }
}

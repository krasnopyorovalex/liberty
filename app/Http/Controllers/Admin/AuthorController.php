<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Domain\Author\Commands\UpdateAuthorPositionsCommand;
use Domain\Author\Commands\CreateAuthorCommand;
use Domain\Author\Commands\DeleteAuthorCommand;
use Domain\Author\Commands\UpdateAuthorCommand;
use Domain\Author\Queries\GetAllAuthorsQuery;
use Domain\Author\Queries\GetAuthorByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Author\Requests\CreateAuthorRequest;
use Domain\Author\Requests\UpdateAuthorRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class AuthorController
 * @package App\Http\Controllers\Admin
 */
class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $authors = $this->dispatch(new GetAllAuthorsQuery);

        return view('admin.authors.index', [
            'authors' => $authors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAuthorRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateAuthorRequest $request)
    {
        $this->dispatch(new CreateAuthorCommand($request));

        return redirect(route('admin.authors.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $author = $this->dispatch(new GetAuthorByIdQuery($id));

        return view('admin.authors.edit', [
            'author' => $author
        ]);
    }

    /**
     * @param int $id
     * @param UpdateAuthorRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, UpdateAuthorRequest $request): RedirectResponse
    {
        $this->dispatch(new UpdateAuthorCommand($id, $request));

        return redirect(route('admin.authors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteAuthorCommand($id));

        return redirect(route('admin.authors.index'));
    }

    public function positions(): bool
    {
        $this->dispatch(new UpdateAuthorPositionsCommand(request()->post('data')));

        return true;
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Redirect\Commands\CreateRedirectCommand;
use Domain\Redirect\Commands\DeleteRedirectCommand;
use Domain\Redirect\Commands\UpdateRedirectCommand;
use Domain\Redirect\Queries\GetAllRedirectsQuery;
use Domain\Redirect\Queries\GetRedirectByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Redirect\Requests\CreateRedirectRequest;
use Domain\Redirect\Requests\UpdateRedirectRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class RedirectController
 * @package App\Http\Controllers\Admin
 */
class RedirectController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $redirects = $this->dispatch(new GetAllRedirectsQuery);

        return view('admin.redirects.index', [
            'redirects' => $redirects
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.redirects.create');
    }

    /**
     * @param CreateRedirectRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateRedirectRequest $request)
    {
        $this->dispatch(new CreateRedirectCommand($request));

        return redirect(route('admin.redirects.index'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $redirect = $this->dispatch(new GetRedirectByIdQuery($id));

        return view('admin.redirects.edit', [
            'redirect' => $redirect
        ]);
    }

    /**
     * @param int $id
     * @param UpdateRedirectRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateRedirectRequest $request)
    {
        $this->dispatch(new UpdateRedirectCommand($id, $request));

        return redirect(route('admin.redirects.index'));
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteRedirectCommand($id));

        return redirect(route('admin.redirects.index'));
    }
}

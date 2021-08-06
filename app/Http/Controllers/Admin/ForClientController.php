<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\ForClient\Commands\CreateForClientCommand;
use Domain\ForClient\Commands\DeleteForClientCommand;
use Domain\ForClient\Commands\UpdateForClientCommand;
use Domain\ForClient\Queries\GetAllForClientsQuery;
use Domain\ForClient\Queries\GetForClientByIdQuery;
use App\Http\Controllers\Controller;
use Domain\ForClient\Requests\CreateForClientRequest;
use Domain\ForClient\Requests\UpdateForClientRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class ForClientController
 * @package App\Http\Controllers\Admin
 */
class ForClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $forClients = $this->dispatch(new GetAllForClientsQuery);

        return view('admin.for-clients.index', [
            'forClients' => $forClients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.for-clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateForClientRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateForClientRequest $request)
    {
        $this->dispatch(new CreateForClientCommand($request));

        return redirect(route('admin.for_clients.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $forClient = $this->dispatch(new GetForClientByIdQuery($id));

        return view('admin.for-clients.edit', [
            'forClient' => $forClient
        ]);
    }

    /**
     * @param int $id
     * @param UpdateForClientRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, UpdateForClientRequest $request): RedirectResponse
    {
        $this->dispatch(new UpdateForClientCommand($id, $request));

        return redirect(route('admin.for_clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteForClientCommand($id));

        return redirect(route('admin.for_clients.index'));
    }
}

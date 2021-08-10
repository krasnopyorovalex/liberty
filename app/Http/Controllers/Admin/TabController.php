<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Domain\Tab\Commands\CreateTabCommand;
use Domain\Tab\Commands\DeleteTabCommand;
use Domain\Tab\Commands\UpdateTabCommand;
use Domain\Tab\Queries\GetAllTabsQuery;
use Domain\Tab\Queries\GetTabByIdQuery;
use Domain\Tab\Requests\CreateTabRequest;
use Domain\Tab\Requests\UpdateTabRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class TabController
 * @package App\Http\Controllers\Admin
 */
class TabController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $tabs = $this->dispatch(new GetAllTabsQuery());

        return view('admin.tabs.index', [
            'tabs' => $tabs
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.tabs.create');
    }

    /**
     * @param CreateTabRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateTabRequest $request)
    {
        $this->dispatch(new CreateTabCommand($request));

        return redirect(route('admin.tabs.index'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $tab = $this->dispatch(new GetTabByIdQuery($id));

        return view('admin.tabs.edit', [
            'tab' => $tab
        ]);
    }

    /**
     * @param $id
     * @param UpdateTabRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update($id, UpdateTabRequest $request)
    {
        $this->dispatch(new UpdateTabCommand($id, $request));

        return redirect(route('admin.tabs.index'));
    }

    /**
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteTabCommand($id));

        return redirect(route('admin.tabs.index'));
    }
}

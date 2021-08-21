<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Menu\Commands\CreateMenuCommand;
use Domain\Menu\Commands\DeleteMenuCommand;
use Domain\Menu\Commands\UpdateMenuCommand;
use Domain\Menu\Queries\GetAllMenusQuery;
use Domain\Menu\Queries\GetMenuByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Menu\Requests\CreateMenuRequest;
use Domain\Menu\Requests\UpdateMenuRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class MenuController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $menus = $this->dispatch(new GetAllMenusQuery());

        return view('admin.menus.index', [
            'menus' => $menus
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * @param CreateMenuRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateMenuRequest $request)
    {
        $this->dispatch(new CreateMenuCommand($request));

        return redirect(route('admin.menus.index'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $menu = $this->dispatch(new GetMenuByIdQuery($id));

        return view('admin.menus.edit', [
            'menu' => $menu
        ]);
    }

    /**
     * @param int $id
     * @param UpdateMenuRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateMenuRequest $request)
    {
        $this->dispatch(new UpdateMenuCommand($id, $request));

        return redirect(route('admin.menus.index'));
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteMenuCommand($id));

        return redirect(route('admin.menus.index'));
    }
}

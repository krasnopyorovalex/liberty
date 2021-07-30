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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateMenuRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateMenuRequest $request)
    {
        $this->dispatch(new CreateMenuCommand($request));

        return redirect(route('admin.menus.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $menu = $this->dispatch(new GetMenuByIdQuery($id));

        return view('admin.menus.edit', [
            'menu' => $menu
        ]);
    }

    /**
     * @param $id
     * @param UpdateMenuRequest $request
     * @return RedirectResponse
     */
    public function update($id, UpdateMenuRequest $request)
    {
        $this->dispatch(new UpdateMenuCommand($id, $request));

        return redirect(route('admin.menus.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteMenuCommand($id));

        return redirect(route('admin.menus.index'));
    }
}

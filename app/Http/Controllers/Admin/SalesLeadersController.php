<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Domain\SalesLeaders\Commands\CreateSalesLeadersCommand;
use App\Domain\SalesLeaders\Commands\DeleteSalesLeadersCommand;
use App\Domain\SalesLeaders\Commands\UpdateSalesLeadersCommand;
use App\Domain\SalesLeaders\Queries\GetAllSalesLeadersQuery;
use App\Domain\SalesLeaders\Queries\GetSalesLeaderByIdQuery;
use App\Http\Controllers\Controller;
use Domain\SalesLeaders\Requests\CreateSalesLeaderRequest;
use Domain\SalesLeaders\Requests\UpdateSalesLeaderRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class SalesLeadersController
 * @package App\Http\Controllers\Admin
 */
class SalesLeadersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $salesLeaders = $this->dispatch(new GetAllSalesLeadersQuery);

        return view('admin.sales_leaders.index', [
            'salesLeaders' => $salesLeaders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.sales_leaders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSalesLeaderRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateSalesLeaderRequest $request)
    {
        $this->dispatch(new CreateSalesLeadersCommand($request));

        return redirect(route('admin.sales_leaders.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $salesLeader = $this->dispatch(new GetSalesLeaderByIdQuery($id));

        return view('admin.sales_leaders.edit', [
            'salesLeader' => $salesLeader
        ]);
    }

    /**
     * @param int $id
     * @param UpdateSalesLeaderRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, UpdateSalesLeaderRequest $request): RedirectResponse
    {
        $this->dispatch(new UpdateSalesLeadersCommand($id, $request));

        return redirect(route('admin.sales_leaders.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteSalesLeadersCommand($id));

        return redirect(route('admin.sales_leaders.index'));
    }

    /**
     * @param int $id
     * @return string[]
     */
    public function destroyImage(int $id): array
    {
        $salesLeader = $this->dispatch(new GetSalesLeaderByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $salesLeader->image))) {
            $salesLeader->update(['image' => '']);
        }

        return [
            'message' => 'Изображение удалено'
        ];
    }

    /**
     * @param int $id
     * @return string[]
     */
    public function destroyImageMob(int $id): array
    {
        $salesLeader = $this->dispatch(new GetSalesLeaderByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $salesLeader->image_mob))) {
            $salesLeader->update(['image_mob' => '']);
        }

        return [
            'message' => 'Изображение удалено'
        ];
    }
}

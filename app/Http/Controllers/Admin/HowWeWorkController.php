<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\HowWeWork\Commands\CreateHowWeWorkCommand;
use Domain\HowWeWork\Commands\DeleteHowWeWorkCommand;
use Domain\HowWeWork\Commands\UpdateHowWeWorkCommand;
use Domain\HowWeWork\Queries\GetAllHowWeWorksQuery;
use Domain\HowWeWork\Queries\GetHowWeWorkByIdQuery;
use App\Http\Controllers\Controller;
use Domain\HowWeWork\Requests\CreateHowWeWorkRequest;
use Domain\HowWeWork\Requests\UpdateHowWeWorkRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class HowWeWorkController
 * @package App\Http\Controllers\Admin
 */
class HowWeWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $howWeWorks = $this->dispatch(new GetAllHowWeWorksQuery);

        return view('admin.how-we-works.index', [
            'howWeWorks' => $howWeWorks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.how-we-works.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateHowWeWorkRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateHowWeWorkRequest $request)
    {
        $this->dispatch(new CreateHowWeWorkCommand($request));

        return redirect(route('admin.how_we_works.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $howWeWork = $this->dispatch(new GetHowWeWorkByIdQuery($id));

        return view('admin.how-we-works.edit', [
            'howWeWork' => $howWeWork
        ]);
    }

    /**
     * @param int $id
     * @param UpdateHowWeWorkRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, UpdateHowWeWorkRequest $request): RedirectResponse
    {
        $this->dispatch(new UpdateHowWeWorkCommand($id, $request));

        return redirect(route('admin.how_we_works.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteHowWeWorkCommand($id));

        return redirect(route('admin.how_we_works.index'));
    }
}

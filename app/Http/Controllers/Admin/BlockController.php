<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Domain\Block\Commands\CreateBlockCommand;
use Domain\Block\Commands\DeleteBlockCommand;
use Domain\Block\Commands\UpdateBlockCommand;
use Domain\Block\Queries\GetAllBlocksQuery;
use Domain\Block\Queries\GetBlockByIdQuery;
use Domain\Block\Requests\CreateBlockRequest;
use Domain\Block\Requests\UpdateBlockRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class BlockController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $blocks = $this->dispatch(new GetAllBlocksQuery());

        return view('admin.blocks.index', [
            'blocks' => $blocks
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.blocks.create');
    }

    /**
     * @param CreateBlockRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateBlockRequest $request)
    {
        $this->dispatch(new CreateBlockCommand($request));

        return redirect(route('admin.blocks.index'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $block = $this->dispatch(new GetBlockByIdQuery($id));

        return view('admin.blocks.edit', [
            'block' => $block
        ]);
    }

    /**
     * @param int $id
     * @param UpdateBlockRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateBlockRequest $request)
    {
        $this->dispatch(new UpdateBlockCommand($id, $request));

        return redirect(route('admin.blocks.index'));
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteBlockCommand($id));

        return redirect(route('admin.blocks.index'));
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\SalesLeaders\Commands;

use App\Domain\SalesLeaders\Queries\GetSalesLeaderByIdQuery;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use App\Models\SalesLeaders;
use Closure;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class UpdateSalesLeadersCommand
 * @package App\Domain\SalesLeaders\Commands
 */
class UpdateSalesLeadersCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;
    private Closure $deleter;

    /**
     * UpdateSalesLeadersCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;

        $this->deleter = static fn (string $path) => Storage::delete($path);
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $salesLeader = $this->dispatch(new GetSalesLeaderByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($salesLeader->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($salesLeader->getOriginal('alias'), $urlNew));
        }

        if ($this->request->has('image')) {
            if ($salesLeader->image) {
                ($this->deleter)(str_replace('/storage/', '/public/', $salesLeader->image));
            }

            $path = $this->request->file('image')->store(SalesLeaders::STORE_PATH);
            $salesLeader->image = Storage::url($path);
        }

        if ($this->request->has('image_mob')) {
            if ($salesLeader->image_mob) {
                ($this->deleter)(str_replace('/storage/', '/public/', $salesLeader->image_mob));
            }

            $path = $this->request->file('image_mob')->store(SalesLeaders::STORE_PATH);
            $salesLeader->image_mob = Storage::url($path);
        }

        return $salesLeader->update($this->request->validated());
    }
}

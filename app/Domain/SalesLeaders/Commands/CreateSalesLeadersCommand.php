<?php

declare(strict_types=1);

namespace App\Domain\SalesLeaders\Commands;

use App\Http\Requests\Request;
use App\Models\SalesLeaders;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class CreateSalesLeadersCommand
 * @package App\Domain\SalesLeaders\Commands
 */
class CreateSalesLeadersCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateSalesLeadersCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $salesLeader = new SalesLeaders();
        $salesLeader->fill($this->request->all());

        if ($this->request->has('image')) {
            $path = $this->request->file('image')->store(SalesLeaders::STORE_PATH);
            $salesLeader->image = Storage::url($path);
        }

        if ($this->request->has('image_mob')) {
            $path = $this->request->file('image_mob')->store(SalesLeaders::STORE_PATH);
            $salesLeader->image_mob = Storage::url($path);
        }

        $salesLeader->save();

        return true;
    }
}

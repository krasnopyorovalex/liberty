<?php

declare(strict_types=1);

namespace Domain\WhyChooseUs\Queries;

use App\Models\WhyChooseUs;

/**
 * Class GetAllWhyChooseUssQuery
 * @package Domain\WhyChooseUs\Queries
 */
class GetAllWhyChooseUsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return WhyChooseUs::all();
    }
}

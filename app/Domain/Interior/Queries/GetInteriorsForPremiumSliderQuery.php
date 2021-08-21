<?php

declare(strict_types=1);

namespace Domain\Interior\Queries;

use App\Models\Interior;

class GetInteriorsForPremiumSliderQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Interior::where('is_favorite', '1')->get();
    }
}

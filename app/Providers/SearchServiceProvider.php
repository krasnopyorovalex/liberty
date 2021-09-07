<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\Search;
use App\Services\SqlSearch;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Search::class, function () {
            return new SqlSearch();
        });
    }
}

<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\PortfolioTypesComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

class PortfolioTypesServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer([
            'page.portfolio'
        ], PortfolioTypesComposer::class);
    }
}

<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\PortfolioComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

class PortfoliosServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer([
            'page.portfolio'
        ], PortfolioComposer::class);
    }
}

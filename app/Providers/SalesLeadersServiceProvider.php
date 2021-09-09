<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\SalesLeadersComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

class SalesLeadersServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer([
            'layouts.sections.sales-leaders'
        ], SalesLeadersComposer::class);
    }
}

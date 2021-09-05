<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\ForClientsComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

class ForClientsServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer([
            'layouts.sections.for-clients'
        ], ForClientsComposer::class);
    }
}

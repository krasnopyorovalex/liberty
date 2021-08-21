<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\FurnitureTypeComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

class FurnitureTypeServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer('layouts.app', FurnitureTypeComposer::class);
    }
}

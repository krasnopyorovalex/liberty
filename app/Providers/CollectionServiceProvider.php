<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\CollectionComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

class CollectionServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer('layouts.app', CollectionComposer::class);
    }
}

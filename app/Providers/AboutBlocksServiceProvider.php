<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\AboutBlocksComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

class AboutBlocksServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer('layouts.sections.about-blocks', AboutBlocksComposer::class);
    }
}

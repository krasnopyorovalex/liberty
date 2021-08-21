<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\HowWeWorkComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

class HowWeWorkServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer('layouts.sections.how-we-work', HowWeWorkComposer::class);
    }
}

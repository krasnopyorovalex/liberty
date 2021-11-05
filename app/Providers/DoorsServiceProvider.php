<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\DoorsComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

class DoorsServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer([
            'layouts.sections.doors',
            'layouts.app'
        ], DoorsComposer::class);
    }
}

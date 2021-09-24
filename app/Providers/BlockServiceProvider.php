<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\BlockComposer;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class BlockServiceProvider extends ServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function register()
    {
        $this->app->make('view')->composer(
            ['layouts.app'],
            BlockComposer::class
        );
    }
}

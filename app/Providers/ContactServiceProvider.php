<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\ContactComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer([
            'page.contacts'
        ], ContactComposer::class);
    }
}

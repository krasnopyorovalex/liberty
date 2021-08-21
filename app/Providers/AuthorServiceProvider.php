<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\AuthorComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

class AuthorServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer('layouts.sections.authors', AuthorComposer::class);
    }
}

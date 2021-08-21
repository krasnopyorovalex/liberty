<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\WhyChooseUsComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

class WhyChooseUsServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer('layouts.sections.why-choose-us', WhyChooseUsComposer::class);
    }
}

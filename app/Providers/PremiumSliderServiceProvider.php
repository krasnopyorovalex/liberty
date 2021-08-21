<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\PremiumSliderComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;

class PremiumSliderServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer('layouts.sections.premium-slider', PremiumSliderComposer::class);
    }
}

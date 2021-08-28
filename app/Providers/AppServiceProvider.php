<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::include('includes.input', 'input');
        Blade::include('includes.submit_btn', 'submit_btn');
        Blade::include('includes.textarea', 'textarea');
        Blade::include('includes.checkbox', 'checkbox');
        Blade::include('includes.imageInput', 'imageInput');
        Blade::include('includes.dateInput', 'dateInput');
        Blade::include('includes.selectLink', 'selectLink');
        Blade::include('includes.select', 'select');
        Blade::include('includes.priceInput', 'priceInput');
        Blade::include('includes.fileInput', 'fileInput');

        setlocale(LC_TIME, 'ru_RU.UTF-8');
    }
}

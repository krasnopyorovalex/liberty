<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\Favorite;
use App\Services\SqlFavorite;
use Illuminate\Support\ServiceProvider;

class FavoriteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Favorite::class, function () {
            return new SqlFavorite();
        });
    }
}

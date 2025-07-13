<?php

namespace App\Providers;

use App\Models\Block;
use App\Observers\BlockObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Block::observe(BlockObserver::class);
    }
}

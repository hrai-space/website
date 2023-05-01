<?php

namespace App\Providers;

use App\Providers\CdnService;
use App\Providers\DOCdnService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
        $this->app->bind(CdnService::class, DOCdnService::class);
        Paginator::useBootstrap();

        Blade::if('admin', function(){
            return Auth::check() && Auth::user()->isAdmin();
        });
    }
}

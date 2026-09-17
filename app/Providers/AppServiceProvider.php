<?php

namespace App\Providers;

use App\Models\User;
use App\View\Components\Card;
use App\View\Components\Header;
use App\View\Components\FiltersReports;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('card', Card::class);
        Blade::component('header', Header::class);
        Blade::component('filters-reports', FiltersReports::class);
        if(! app()->isProduction()){
            Model::shouldBeStrict();
        }

        Gate::define('admin', function (User $user) {
        return $user->isAdmin();
    });
    }
}

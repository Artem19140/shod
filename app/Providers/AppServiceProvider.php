<?php

namespace App\Providers;

use App\View\Components\Button;
use App\View\Components\Card;
use App\View\Components\Input;
use App\View\Components\Header;
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
        Blade::component('input', Input::class);
        Blade::component('card', Card::class);
        Blade::component('button', Button::class);
        Blade::component('header', Header::class);
    }
}

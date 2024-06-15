<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Filament\Support\View\Components\Modal;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;

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
        Model::unguard();
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch->locales(['id','en']); // also accepts a closure
        });
        Modal::closedByClickingAway(false);
    }
}

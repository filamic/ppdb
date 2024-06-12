<?php

namespace App\Providers;

use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentView;
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
        // FilamentView::registerRenderHook(
        //     PanelsRenderHook::USER_MENU_BEFORE ,
        //     fn (): View => view('filament.hook.tour-button'),
        // );
    }
}

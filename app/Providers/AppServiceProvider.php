<?php

namespace App\Providers;

use Filament\Support\Assets\Js;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;
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
        // FilamentAsset::register([
        //     Js::make('fslightbox', 'https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.4.1/index.min.js'),
        // ]);
        FilamentAsset::register([
            Js::make('fslightbox', __DIR__ . '/../../resources/js/fslightbox.js'),
            Js::make('collapse-sidebar-by-default-on-mobile', __DIR__ . '/../../resources/js/collapseSidebarByDefaultOnMobile.js'),
        ]);
    }
}

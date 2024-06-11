<?php

namespace App\Providers\Filament;

use Filament\Panel;
use App\Models\School;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use App\Http\Middleware\CheckIfAdmin;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use App\Filament\User\Pages\Tenancy\RegisterSchool;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('user')
            ->path('/')
            ->login()
            // ->emailVerification()
            // ->passwordReset()
            ->registration()
            ->colors([
                'primary' => '#E65C00',
            ])
            ->discoverResources(in: app_path('Filament/User/Resources'), for: 'App\\Filament\\User\\Resources')
            ->discoverPages(in: app_path('Filament/User/Pages'), for: 'App\\Filament\\User\\Pages')
            ->pages([
                // Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/User/Widgets'), for: 'App\\Filament\\User\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->tenantMiddleware([
                CheckIfAdmin::class,
            ])
            ->topNavigation()
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->brandLogo(asset('logo_filamic.svg'))
            ->spa()
            ->tenant(School::class, slugAttribute: 'slug')
            ->tenantRegistration(RegisterSchool::class)
            ->tenantMenuItems([
                'register' => MenuItem::make()->label(__('form.register_at_another_school')),
            ])
            ;
    }
}

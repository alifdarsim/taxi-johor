<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\LatestTaxiOnline;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\ActiveAdvertisement;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin;
use ShuvroRoy\FilamentSpatieLaravelBackup\Pages\Backups;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('dashboard')
            ->path('dashboard')
            ->login()
//            ->colors([
//                'primary' => Color::Red,
//            ])
            ->spa()
            ->spaUrlExceptions(fn (): array => [
                url('/dashboard/live-tracking'),
            ])
            ->font('Poppins')
            ->favicon(asset('favicon-32x32.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                StatsOverview::class,
                LatestTaxiOnline::class,
                ActiveAdvertisement::class
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
                SetTheme::class
            ])
//            ->tenantMiddleware([
//                SetTheme::class
//            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Profile')
                    ->icon('heroicon-o-user')
                    ->url(fn (): string => EditProfilePage::getUrl())
            ])
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->setNavigationGroup('Settings')
                    ->setIcon('heroicon-o-user')
                    ->shouldShowDeleteAccountForm()
                    ->shouldShowBrowserSessionsForm()
                    ->shouldShowAvatarForm(),
//                ThemesPlugin::make(),
                FilamentSpatieLaravelBackupPlugin::make(),
                FilamentSpatieLaravelHealthPlugin::make()
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->renderHook('panels::body.end', fn (): string => Blade::render("@vite('resources/js/app.js')"));
    }
}

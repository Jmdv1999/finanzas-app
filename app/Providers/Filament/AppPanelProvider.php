<?php

namespace App\Providers\Filament;

use Awcodes\FilamentGravatar\GravatarPlugin;
use Awcodes\FilamentGravatar\GravatarProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Pages\Auth\EditProfile;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentGeneralSettings\FilamentGeneralSettingsPlugin;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->defaultAvatarProvider(GravatarProvider::class)
            ->default()
            ->id('app')
            ->path('app')
            ->login()
            ->registration()
            ->colors([
                'primary' => Color::Indigo,
                'danger' => Color::Red,
                'success' => Color::Green,
                'info' => Color::Blue,
                'warning' => Color::Amber
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
        
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
            ->plugins([
                GravatarPlugin::make() 
                    ->default('robohash')
                    ->rating('pg'),
                FilamentGeneralSettingsPlugin::make()
                    ->setSort(1)
                    ->setIcon('heroicon-o-cog')
                    ->setNavigationGroup('Configuracion general')
                    ->setTitle('Configuracion del sitio')
                    ->setNavigationLabel('Configuracion del sitio'),
                FilamentEditProfilePlugin::make()
                    ->setTitle('Mi Perfil')
                    ->setNavigationLabel('Mi perfil')
                    ->setNavigationGroup('Configuracion general')
                    ->setIcon('heroicon-o-user')
                    ->setSort(2)
            ]);
            
    }
}

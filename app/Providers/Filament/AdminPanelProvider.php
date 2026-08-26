<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::hex('#0d631b'),
            ])
            ->darkMode(false) 
            ->brandName('Admin Lembur Sawah')
            ->brandLogo(asset('assets/images/logo.webp'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('favicon.ico'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
            ])
            ->renderHook(
                \Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
                fn () => \Illuminate\Support\Facades\Blade::render('
                    <style>
                        body {
                            background-image: url("{{ asset(\'assets/images/auth-bg.jpg\') }}") !important;
                            background-size: cover !important;
                            background-position: center !important;
                            background-attachment: fixed !important;
                            background-color: transparent !important;
                        }
                        img.fi-logo {
                            height: 8rem !important;
                        }
                        body::before {
                            content: "";
                            position: fixed;
                            inset: 0;
                            background: rgba(0, 0, 0, 0.4);
                            backdrop-filter: blur(4px);
                            z-index: -1;
                        }
                        .fi-simple-main, .fi-simple-layout > main {
                            background: rgba(255, 255, 255, 0.85) !important;
                            backdrop-filter: blur(12px) !important;
                            border-radius: 1.5rem !important;
                            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
                            border: 1px solid rgba(255,255,255,0.4) !important;
                            overflow: hidden;
                        }
                    </style>
                ')
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}

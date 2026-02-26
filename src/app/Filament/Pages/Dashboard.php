<?php

namespace App\Filament\Pages;

use Filament\Panel;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $routePath = '/dashboard';

    public static function getRoutePath(Panel $panel): string
    {
        return static::$routePath;
    }
}

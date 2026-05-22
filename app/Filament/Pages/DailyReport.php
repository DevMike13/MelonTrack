<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DailyReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static string $view = 'filament.pages.daily-report';

    protected static ?string $navigationLabel = 'Daily Records';

    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role == 'admin';
    }
}

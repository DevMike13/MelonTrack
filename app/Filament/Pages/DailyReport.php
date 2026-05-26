<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DailyReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-folder-open';

    protected static string $view = 'filament.pages.daily-report';

    protected static ?string $navigationLabel = 'Monthly Records';

    protected static ?int $navigationSort = 3;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role == 'admin';
    }
}

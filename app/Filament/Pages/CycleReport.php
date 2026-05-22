<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CycleReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';
    protected static ?int $navigationSort = 50;
    protected static string $view = 'filament.pages.cycle-report';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}

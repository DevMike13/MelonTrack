<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class FeedingSchedule extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static string $view = 'filament.pages.feeding-schedule';

    protected static ?int $navigationSort = 50;
    
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}

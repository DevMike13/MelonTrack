<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ManualControls extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-ripple';
    protected static ?int $navigationSort = 80;
    protected static string $view = 'filament.pages.manual-controls';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}

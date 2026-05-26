<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ParametersMonitoring extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static string $view = 'filament.pages.parameters-monitoring';

    protected static ?int $navigationSort = 2;

    // public static function shouldRegisterNavigation(): bool
    // {
    //     return false;
    // }
}

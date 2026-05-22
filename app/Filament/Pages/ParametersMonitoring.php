<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ParametersMonitoring extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static string $view = 'filament.pages.parameters-monitoring';

    protected static ?int $navigationSort = 30;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}

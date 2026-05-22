<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Personnel extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static string $view = 'filament.pages.personnel';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = "User Management";

    protected static ?string $title = 'User Management';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role == 'admin';
    }
}

<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class UserManual extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-circle';

    protected static string $view = 'filament.pages.user-manual';

    protected static ?string $navigationLabel = "Grower's Guide";

    protected static ?int $navigationSort = 4;
}

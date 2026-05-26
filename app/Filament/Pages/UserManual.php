<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class UserManual extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static string $view = 'filament.pages.user-manual';

    protected static ?string $navigationLabel = "Grower's Guide";

    protected static ?int $navigationSort = 1;

    protected ?string $heading = "Grower's Guide";

    // protected ?string $subheading = 'Manage house models, subdivision lots, and client properties';

    protected static ?string $slug = 'growers-guide';
}

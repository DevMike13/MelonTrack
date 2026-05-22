<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CycleDetails extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-viewfinder-circle';

    protected static string $view = 'filament.pages.cycle-details';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Cultivation Cycles';
    
    protected static ?string $title = 'Cultivation Cycle';
}

<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CycleDetails extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-calendar-date-range';

    protected static string $view = 'filament.pages.cycle-details';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Cycle Details';
    
    protected static ?string $title = 'Cycle Details';
}

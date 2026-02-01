<?php

namespace App\Filament\Resources\BlogPostResource\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DailyScheduleWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                // ...
            )
            ->columns([
                // ...
            ]);
    }
}

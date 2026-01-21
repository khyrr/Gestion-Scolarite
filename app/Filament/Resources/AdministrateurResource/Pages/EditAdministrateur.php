<?php

namespace App\Filament\Resources\AdministrateurResource\Pages;

use App\Filament\Resources\AdministrateurResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdministrateur extends EditRecord
{
    protected static string $resource = AdministrateurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\EtudiantResource\Pages;

use App\Filament\Resources\EtudiantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEtudiant extends EditRecord
{
    protected static string $resource = EtudiantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\EtudePaiementResource\Pages;

use App\Filament\Resources\EtudePaiementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEtudePaiement extends EditRecord
{
    protected static string $resource = EtudePaiementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

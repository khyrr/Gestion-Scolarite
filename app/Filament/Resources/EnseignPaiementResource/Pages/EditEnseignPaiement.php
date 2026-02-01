<?php

namespace App\Filament\Resources\EnseignPaiementResource\Pages;

use App\Filament\Resources\EnseignPaiementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEnseignPaiement extends EditRecord
{
    protected static string $resource = EnseignPaiementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

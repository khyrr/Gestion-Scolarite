<?php

namespace App\Filament\Widgets;

use App\Models\Cours;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class DailyScheduleWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function getTableHeading(): string | \Illuminate\Contracts\Support\Htmlable | null
    {
        $dayMap = [
            'Monday' => 'lundi',
            'Tuesday' => 'mardi',
            'Wednesday' => 'mercredi',
            'Thursday' => 'jeudi',
            'Friday' => 'vendredi',
            'Saturday' => 'samedi',
            'Sunday' => 'dimanche',
        ];
        
        $todayKey = $dayMap[Carbon::now()->format('l')];
        return __('app.emploi_du_temps') . ' - ' . __("app.$todayKey") . ' (' . Carbon::now()->format('d/m/Y') . ')';
    }

    public function table(Table $table): Table
    {
        $dayMap = [
            'Monday' => 'lundi',
            'Tuesday' => 'mardi',
            'Wednesday' => 'mercredi',
            'Thursday' => 'jeudi',
            'Friday' => 'vendredi',
            'Saturday' => 'samedi',
            'Sunday' => 'dimanche',
        ];

        $todayKey = $dayMap[Carbon::now()->format('l')];

        return $table
            ->query(
                Cours::query()
                    ->where('jour', $todayKey)
                    ->orderBy('date_debut')
            )
            ->columns([
                Tables\Columns\TextColumn::make('classe.nom_classe')
                    ->label(__('app.classe'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('matiere.nom_matiere')
                    ->label(__('app.matiere')),
                Tables\Columns\TextColumn::make('enseignant.nom')
                    ->label(__('app.enseignant'))
                    ->formatStateUsing(fn ($record) => ($record->enseignant->nom ?? '') . ' ' . ($record->enseignant->prenom ?? '')),
                Tables\Columns\TextColumn::make('date_debut')
                    ->label(__('app.debut'))
                    ->time('H:i'),
                Tables\Columns\TextColumn::make('date_fin')
                    ->label(__('app.fin'))
                    ->time('H:i'),
            ])
            ->paginated(false);
    }
}

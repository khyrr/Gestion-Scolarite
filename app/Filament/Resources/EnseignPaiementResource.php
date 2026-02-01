<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnseignPaiementResource\Pages;
use App\Filament\Resources\EnseignPaiementResource\RelationManagers;
use App\Models\EnseignPaiement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnseignPaiementResource extends Resource
{
    protected static ?string $model = EnseignPaiement::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('app.gestion_financiere');
    }

    public static function getNavigationLabel(): string
    {
        return __('app.paiements_enseignants');
    }

    public static function getPluralLabel(): string
    {
        return __('app.paiements_enseignants');
    }

    public static function getModelLabel(): string
    {
        return __('app.paiements_enseignants');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('super_admin') || auth()->user()->can('manage payments');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Payment Information')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Teacher')
                            ->relationship('enseignant', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                            
                        Forms\Components\Select::make('typepaiement')
                            ->label('Payment Type')
                            ->required()
                            ->options([
                                'salaire' => 'Salary',
                                'prime' => 'Bonus',
                                'avance' => 'Advance',
                                'autre' => 'Other',
                            ]),
                            
                        Forms\Components\TextInput::make('montant')
                            ->label('Amount')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0)
                            ->default(0.00),
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Payment Status')
                    ->schema([
                        Forms\Components\Select::make('statut')
                            ->label('Status')
                            ->required()
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('pending'),
                            
                        Forms\Components\DatePicker::make('date_paiement')
                            ->label('Payment Date')
                            ->displayFormat('d/m/Y')
                            ->default(now()),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('enseignant.name')
                    ->label('Teacher')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('typepaiement')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'salaire' => 'success',
                        'prime' => 'warning',
                        'avance' => 'info',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('montant')
                    ->label('Amount')
                    ->money('USD')
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money('USD'),
                    ]),
                    
                Tables\Columns\TextColumn::make('statut')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('date_paiement')
                    ->label('Payment Date')
                    ->date('d/m/Y')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('statut')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'cancelled' => 'Cancelled',
                    ]),
                    
                Tables\Filters\SelectFilter::make('typepaiement')
                    ->label('Payment Type')
                    ->options([
                        'salaire' => 'Salary',
                        'prime' => 'Bonus',
                        'avance' => 'Advance',
                        'autre' => 'Other',
                    ]),
                    
                Tables\Filters\Filter::make('date_paiement')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('From Date'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Until Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date_paiement', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date_paiement', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('markAsPaid')
                        ->label('Mark as Paid')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['statut' => 'paid']))
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('date_paiement', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEnseignPaiements::route('/'),
            'create' => Pages\CreateEnseignPaiement::route('/create'),
            'edit' => Pages\EditEnseignPaiement::route('/{record}/edit'),
        ];
    }
}

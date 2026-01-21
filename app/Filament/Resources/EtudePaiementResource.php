<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EtudePaiementResource\Pages;
use App\Filament\Resources\EtudePaiementResource\RelationManagers;
use App\Models\EtudePaiement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EtudePaiementResource extends Resource
{
    protected static ?string $model = EtudePaiement::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    
    protected static ?string $navigationGroup = 'Financial';
    
    protected static ?int $navigationSort = 2;
    
    protected static ?string $navigationLabel = 'Student Payments';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Payment Information')
                    ->schema([
                        Forms\Components\Select::make('id_etudiant')
                            ->label('Student')
                            ->relationship('etudiant', 'nom')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->nom} {$record->prenom} ({$record->matricule})")
                            ->required()
                            ->searchable()
                            ->preload(),
                            
                        Forms\Components\Select::make('typepaye')
                            ->label('Payment Type')
                            ->required()
                            ->options([
                                'scolarite' => 'Tuition',
                                'inscription' => 'Registration',
                                'examen' => 'Exam Fees',
                                'uniforme' => 'Uniform',
                                'transport' => 'Transport',
                                'cantine' => 'Cafeteria',
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
                                'partial' => 'Partial',
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
                Tables\Columns\TextColumn::make('etudiant.matricule')
                    ->label('Student ID')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('etudiant.nom')
                    ->label('Student')
                    ->formatStateUsing(fn ($record) => "{$record->etudiant->nom} {$record->etudiant->prenom}")
                    ->searchable(['nom', 'prenom'])
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('typepaye')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'scolarite' => 'primary',
                        'inscription' => 'success',
                        'examen' => 'warning',
                        'transport' => 'info',
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
                        'partial' => 'warning',
                        'pending' => 'info',
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
                Tables\Filters\SelectFilter::make('id_etudiant')
                    ->label('Student')
                    ->relationship('etudiant', 'nom')
                    ->searchable()
                    ->preload(),
                    
                Tables\Filters\SelectFilter::make('statut')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'partial' => 'Partial',
                        'cancelled' => 'Cancelled',
                    ]),
                    
                Tables\Filters\SelectFilter::make('typepaye')
                    ->label('Payment Type')
                    ->options([
                        'scolarite' => 'Tuition',
                        'inscription' => 'Registration',
                        'examen' => 'Exam Fees',
                        'uniforme' => 'Uniform',
                        'transport' => 'Transport',
                        'cantine' => 'Cafeteria',
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
            'index' => Pages\ListEtudePaiements::route('/'),
            'create' => Pages\CreateEtudePaiement::route('/create'),
            'edit' => Pages\EditEtudePaiement::route('/{record}/edit'),
        ];
    }
}

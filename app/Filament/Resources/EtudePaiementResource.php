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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_etudiant')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('typepaye')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('montant')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('statut')
                    ->required(),
                Forms\Components\DatePicker::make('date_paiement'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_etudiant')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('typepaye')
                    ->searchable(),
                Tables\Columns\TextColumn::make('montant')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('statut'),
                Tables\Columns\TextColumn::make('date_paiement')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClasseResource\Pages;
use App\Filament\Resources\ClasseResource\RelationManagers;
use App\Models\Classe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClasseResource extends Resource
{
    protected static ?string $model = Classe::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    
    protected static ?string $navigationGroup = 'Academic Management';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Class Information')
                    ->schema([
                        Forms\Components\TextInput::make('nom_classe')
                            ->label('Class Name')
                            ->required()
                            ->maxLength(191)
                            ->placeholder('e.g., 6ème A, Terminale S'),
                        
                        Forms\Components\TextInput::make('niveau')
                            ->label('Level/Grade')
                            ->required()
                            ->maxLength(191)
                            ->placeholder('e.g., 6ème, Terminale'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom_classe')
                    ->label('Class Name')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('niveau')
                    ->label('Level')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                    
                Tables\Columns\TextColumn::make('etudiants_count')
                    ->label('Students')
                    ->counts('etudiants')
                    ->badge()
                    ->color('success'),
                    
                Tables\Columns\TextColumn::make('cours_count')
                    ->label('Courses')
                    ->counts('cours')
                    ->badge()
                    ->color('warning'),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('niveau')
                    ->label('Level')
                    ->options(function () {
                        return Classe::distinct()->pluck('niveau', 'niveau')->toArray();
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
                ]),
            ])
            ->defaultSort('niveau', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            // Relation managers will be added as needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClasses::route('/'),
            'create' => Pages\CreateClasse::route('/create'),
            'edit' => Pages\EditClasse::route('/{record}/edit'),
        ];
    }
}

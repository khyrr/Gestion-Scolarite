<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoursResource\Pages;
use App\Filament\Resources\CoursResource\RelationManagers;
use App\Models\Cours;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CoursResource extends Resource
{
    protected static ?string $model = Cours::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    
    protected static ?string $navigationGroup = 'Academic Management';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Course Details')
                    ->schema([
                        Forms\Components\Select::make('id_matiere')
                            ->label('Subject')
                            ->relationship('matiere', 'nom_matiere')
                            ->required()
                            ->searchable()
                            ->preload(),
                            
                        Forms\Components\Select::make('id_enseignant')
                            ->label('Teacher')
                            ->relationship('enseignant', 'nom')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->nom} {$record->prenom}")
                            ->required()
                            ->searchable()
                            ->preload(),
                            
                        Forms\Components\Select::make('id_classe')
                            ->label('Class')
                            ->relationship('classe', 'nom_classe')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Schedule')
                    ->schema([
                        Forms\Components\Select::make('jour')
                            ->label('Day of Week')
                            ->required()
                            ->options([
                                'Lundi' => 'Monday',
                                'Mardi' => 'Tuesday',
                                'Mercredi' => 'Wednesday',
                                'Jeudi' => 'Thursday',
                                'Vendredi' => 'Friday',
                                'Samedi' => 'Saturday',
                            ]),
                            
                        Forms\Components\TimePicker::make('date_debut')
                            ->label('Start Time')
                            ->required()
                            ->seconds(false),
                            
                        Forms\Components\TimePicker::make('date_fin')
                            ->label('End Time')
                            ->required()
                            ->seconds(false)
                            ->after('date_debut'),
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Description')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Course Description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('matiere.nom_matiere')
                    ->label('Subject')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                    
                Tables\Columns\TextColumn::make('enseignant.nom')
                    ->label('Teacher')
                    ->formatStateUsing(fn ($record) => "{$record->enseignant->nom} {$record->enseignant->prenom}")
                    ->searchable(['nom', 'prenom'])
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('classe.nom_classe')
                    ->label('Class')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                    
                Tables\Columns\TextColumn::make('jour')
                    ->label('Day')
                    ->badge()
                    ->color('warning'),
                    
                Tables\Columns\TextColumn::make('date_debut')
                    ->label('Start')
                    ->time('H:i'),
                    
                Tables\Columns\TextColumn::make('date_fin')
                    ->label('End')
                    ->time('H:i'),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_enseignant')
                    ->label('Teacher')
                    ->relationship('enseignant', 'nom')
                    ->searchable()
                    ->preload(),
                    
                Tables\Filters\SelectFilter::make('id_classe')
                    ->label('Class')
                    ->relationship('classe', 'nom_classe')
                    ->searchable()
                    ->preload(),
                    
                Tables\Filters\SelectFilter::make('jour')
                    ->label('Day')
                    ->options([
                        'Lundi' => 'Monday',
                        'Mardi' => 'Tuesday',
                        'Mercredi' => 'Wednesday',
                        'Jeudi' => 'Thursday',
                        'Vendredi' => 'Friday',
                        'Samedi' => 'Saturday',
                    ]),
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
            ->defaultSort('jour', 'asc');
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
            'index' => Pages\ListCours::route('/'),
            'create' => Pages\CreateCours::route('/create'),
            'edit' => Pages\EditCours::route('/{record}/edit'),
        ];
    }
}

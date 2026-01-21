<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EtudiantResource\Pages;
use App\Filament\Resources\EtudiantResource\RelationManagers;
use App\Models\Etudiant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\Classe;

class EtudiantResource extends Resource
{
    protected static ?string $model = Etudiant::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationGroup = 'People';
    
    protected static ?int $navigationSort = 1;
    
    protected static ?string $recordTitleAttribute = 'nom';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Student Information')
                    ->schema([
                        Forms\Components\TextInput::make('matricule')
                            ->label('Student ID')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(191)
                            ->placeholder('Auto-generated if left empty'),
                            
                        Forms\Components\TextInput::make('nom')
                            ->label('Last Name')
                            ->required()
                            ->maxLength(191),
                            
                        Forms\Components\TextInput::make('prenom')
                            ->label('First Name')
                            ->required()
                            ->maxLength(191),
                            
                        Forms\Components\DatePicker::make('date_naissance')
                            ->label('Date of Birth')
                            ->required()
                            ->maxDate(now()->subYears(5))
                            ->displayFormat('d/m/Y'),
                            
                        Forms\Components\Select::make('genre')
                            ->label('Gender')
                            ->required()
                            ->options([
                                'M' => 'Male',
                                'F' => 'Female',
                            ]),
                            
                        Forms\Components\Select::make('id_classe')
                            ->label('Class')
                            ->relationship('classe', 'nom_classe')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->maxLength(191),
                            
                        Forms\Components\TextInput::make('telephone')
                            ->label('Phone Number')
                            ->tel()
                            ->required()
                            ->maxLength(191),
                            
                        Forms\Components\Textarea::make('adresse')
                            ->label('Address')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('matricule')
                    ->label('Student ID')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->badge()
                    ->color('primary'),
                    
                Tables\Columns\TextColumn::make('nom')
                    ->label('Last Name')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('prenom')
                    ->label('First Name')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('classe.nom_classe')
                    ->label('Class')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                    
                Tables\Columns\TextColumn::make('date_naissance')
                    ->label('Birth Date')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),
                    
                Tables\Columns\TextColumn::make('genre')
                    ->label('Gender')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'M' => 'blue',
                        'F' => 'pink',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('telephone')
                    ->label('Phone')
                    ->searchable()
                    ->toggleable()
                    ->copyable()
                    ->icon('heroicon-o-phone'),
                    
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->copyable()
                    ->icon('heroicon-o-envelope'),
                    
                Tables\Columns\TextColumn::make('notes_count')
                    ->label('Grades')
                    ->counts('notes')
                    ->badge()
                    ->color('success')
                    ->toggleable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Enrolled')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_classe')
                    ->label('Class')
                    ->relationship('classe', 'nom_classe')
                    ->searchable()
                    ->preload(),
                    
                Tables\Filters\SelectFilter::make('genre')
                    ->label('Gender')
                    ->options([
                        'M' => 'Male',
                        'F' => 'Female',
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
                    Tables\Actions\BulkAction::make('changeClass')
                        ->label('Change Class')
                        ->icon('heroicon-o-arrow-path')
                        ->form([
                            Forms\Components\Select::make('id_classe')
                                ->label('New Class')
                                ->relationship('classe', 'nom_classe')
                                ->required()
                                ->searchable()
                                ->preload(),
                        ])
                        ->action(function (array $data, $records) {
                            $records->each->update(['id_classe' => $data['id_classe']]);
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('nom', 'asc');
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
            'index' => Pages\ListEtudiants::route('/'),
            'create' => Pages\CreateEtudiant::route('/create'),
            'edit' => Pages\EditEtudiant::route('/{record}/edit'),
        ];
    }
}

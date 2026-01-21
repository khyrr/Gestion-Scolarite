<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoteResource\Pages;
use App\Filament\Resources\NoteResource\RelationManagers;
use App\Models\Note;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\\Models\\Evaluation;

class NoteResource extends Resource
{
    protected static ?string $model = Note::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    
    protected static ?string $navigationGroup = 'Academic Management';
    
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\\Components\\Section::make('Grade Information')
                    ->schema([
                        Forms\\Components\\Select::make('id_etudiant')
                            ->label('Student')
                            ->relationship('etudiant', 'nom')
                            ->getOptionLabelFromRecordUsing(fn ($record) => \"{$record->nom} {$record->prenom} ({$record->matricule})\")
                            ->required()
                            ->searchable()
                            ->preload(),
                            
                        Forms\\Components\\Select::make('id_evaluation')
                            ->label('Evaluation')
                            ->relationship('evaluation', 'titre')
                            ->getOptionLabelFromRecordUsing(fn ($record) => \"{$record->titre} ({$record->matiere->nom_matiere})\")
                            ->required()
                            ->searchable()
                            ->reactive()
                            ->preload()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $evaluation = Evaluation::find($state);
                                    if ($evaluation) {
                                        $set('id_matiere', $evaluation->id_matiere);
                                        $set('id_classe', $evaluation->id_classe);
                                        $set('type', $evaluation->type);
                                    }
                                }
                            }),
                    ])
                    ->columns(2),
                    
                Forms\\Components\\Section::make('Score')
                    ->schema([
                        Forms\\Components\\TextInput::make('note')
                            ->label('Score')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->helperText('Score must not exceed evaluation max score')
                            ->live(onBlur: true),
                            
                        Forms\\Components\\Textarea::make('commentaire')
                            ->label('Comments')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
                    
                Forms\\Components\\Section::make('Auto-filled')
                    ->schema([
                        Forms\\Components\\Hidden::make('id_matiere'),
                        Forms\\Components\\Hidden::make('id_classe'),
                        Forms\\Components\\Hidden::make('type'),
                    ])
                    ->hidden(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\\Columns\\TextColumn::make('etudiant.matricule')
                    ->label('Student ID')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                    
                Tables\\Columns\\TextColumn::make('etudiant.nom')
                    ->label('Student')
                    ->formatStateUsing(fn ($record) => \"{$record->etudiant->nom} {$record->etudiant->prenom}\")
                    ->searchable(['nom', 'prenom'])
                    ->sortable(),
                    
                Tables\\Columns\\TextColumn::make('evaluation.titre')
                    ->label('Evaluation')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->matiere->nom_matiere ?? 'N/A'),
                    
                Tables\\Columns\\TextColumn::make('note')
                    ->label('Score')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn ($state, $record) => {
                        $max = $record->evaluation->note_max ?? 20;
                        $percent = ($state / $max) * 100;
                        if ($percent >= 75) return 'success';
                        if ($percent >= 50) return 'warning';
                        return 'danger';
                    })
                    ->formatStateUsing(fn ($state, $record) => {
                        $max = $record->evaluation->note_max ?? 20;
                        $percent = number_format(($state / $max) * 100, 1);
                        return \"{$state}/{$max} ({$percent}%)\";
                    }),
                    
                Tables\\Columns\\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'examen' => 'danger',
                        'controle' => 'warning',
                        'interrogation' => 'info',
                        'devoir' => 'success',
                        'projet' => 'primary',
                        default => 'gray',
                    }),
                    
                Tables\\Columns\\TextColumn::make('classe.nom_classe')
                    ->label('Class')
                    ->sortable()
                    ->toggleable(),
                    
                Tables\\Columns\\TextColumn::make('created_at')
                    ->label('Entered')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\\Filters\\SelectFilter::make('id_etudiant')
                    ->label('Student')
                    ->relationship('etudiant', 'nom')
                    ->searchable()
                    ->preload(),
                    
                Tables\\Filters\\SelectFilter::make('id_evaluation')
                    ->label('Evaluation')
                    ->relationship('evaluation', 'titre')
                    ->searchable()
                    ->preload(),
                    
                Tables\\Filters\\SelectFilter::make('id_classe')
                    ->label('Class')
                    ->relationship('classe', 'nom_classe')
                    ->searchable()
                    ->preload(),
                    
                Tables\\Filters\\SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'devoir' => 'Homework',
                        'interrogation' => 'Quiz',
                        'examen' => 'Exam',
                        'controle' => 'Test',
                        'projet' => 'Project',
                    ]),
            ])
            ->actions([
                Tables\\Actions\\ViewAction::make(),
                Tables\\Actions\\EditAction::make(),
                Tables\\Actions\\DeleteAction::make()
                    ->label('Delete')
                    ->modalHeading('Delete Grade')
                    ->modalDescription('Are you sure you want to delete this grade? This action will be logged.')
                    ->successNotificationTitle('Grade deleted'),
            ])
            ->bulkActions([
                Tables\\Actions\\BulkActionGroup::make([
                    Tables\\Actions\\DeleteBulkAction::make()
                        ->modalHeading('Delete Grades')
                        ->modalDescription('Are you sure? All deletions will be logged.'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListNotes::route('/'),
            'create' => Pages\CreateNote::route('/create'),
            'edit' => Pages\EditNote::route('/{record}/edit'),
        ];
    }
}

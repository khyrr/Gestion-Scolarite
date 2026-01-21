<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluationResource\Pages;
use App\Filament\Resources\EvaluationResource\RelationManagers;
use App\Models\Evaluation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EvaluationResource extends Resource
{
    protected static ?string $model = Evaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    
    protected static ?string $navigationGroup = 'Academic Management';
    
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Evaluation Details')
                    ->schema([
                        Forms\Components\TextInput::make('titre')
                            ->label('Title')
                            ->maxLength(191)
                            ->placeholder('e.g., Midterm Exam, Quiz 1'),
                            
                        Forms\Components\Select::make('type')
                            ->label('Type')
                            ->required()
                            ->options([
                                'devoir' => 'Homework',
                                'interrogation' => 'Quiz',
                                'examen' => 'Exam',
                                'controle' => 'Test',
                                'projet' => 'Project',
                            ]),
                            
                        Forms\Components\Select::make('id_matiere')
                            ->label('Subject')
                            ->relationship('matiere', 'nom_matiere')
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
                    ->columns(2),
                    
                Forms\Components\Section::make('Grading')
                    ->schema([
                        Forms\Components\TextInput::make('note_max')
                            ->label('Maximum Score')
                            ->required()
                            ->numeric()
                            ->default(20.00)
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('pts'),
                            
                        Forms\Components\DatePicker::make('date')
                            ->label('Evaluation Date')
                            ->required()
                            ->displayFormat('d/m/Y'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titre')
                    ->label('Title')
                    ->searchable()
                    ->description(fn ($record) => $record->type),
                    
                Tables\Columns\TextColumn::make('type')
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
                    
                Tables\Columns\TextColumn::make('matiere.nom_matiere')
                    ->label('Subject')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('classe.nom_classe')
                    ->label('Class')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                    
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('note_max')
                    ->label('Max Score')
                    ->numeric()
                    ->sortable()
                    ->suffix(' pts'),
                    
                Tables\Columns\TextColumn::make('notes_count')
                    ->label('Grades')
                    ->counts('notes')
                    ->badge()
                    ->color('success'),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'devoir' => 'Homework',
                        'interrogation' => 'Quiz',
                        'examen' => 'Exam',
                        'controle' => 'Test',
                        'projet' => 'Project',
                    ]),
                    
                Tables\Filters\SelectFilter::make('id_matiere')
                    ->label('Subject')
                    ->relationship('matiere', 'nom_matiere')
                    ->searchable()
                    ->preload(),
                    
                Tables\Filters\SelectFilter::make('id_classe')
                    ->label('Class')
                    ->relationship('classe', 'nom_classe')
                    ->searchable()
                    ->preload(),
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
            ->defaultSort('date', 'desc');
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
            'index' => Pages\ListEvaluations::route('/'),
            'create' => Pages\CreateEvaluation::route('/create'),
            'edit' => Pages\EditEvaluation::route('/{record}/edit'),
        ];
    }
}

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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EvaluationResource extends Resource
{
    protected static ?string $model = Evaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    
    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return __('app.gestion_academique');
    }

    public static function getNavigationLabel(): string
    {
        return __('app.evaluations');
    }

    public static function getPluralLabel(): string
    {
        return __('app.evaluations');
    }

    public static function getModelLabel(): string
    {
        return __('app.evaluation');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasPermissionTo('view evaluations');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasPermissionTo('create evaluations');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->hasPermissionTo('edit evaluations');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->hasPermissionTo('delete evaluations');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Evaluation Details')
                    ->visible(fn () => auth()->user()->hasPermissionTo('create evaluations') || auth()->user()->hasPermissionTo('edit evaluations'))
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
                    ->visible(fn () => auth()->user()->hasPermissionTo('create evaluations') || auth()->user()->hasPermissionTo('edit evaluations'))
                    ->schema([
                        Forms\Components\TextInput::make('note_max')
                            ->label(__('app.note_maximum'))
                            ->required()
                            ->numeric()
                            ->default(20.00)
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix(__('app.point')),
                            
                        Forms\Components\DatePicker::make('date')
                            ->label(__('app.date_evaluation'))
                            ->required()
                            ->displayFormat('d/m/Y'),
                    ])
                    ->columns(2),
                    
                // Read-only evaluation view for users with view-only permissions
                Forms\Components\Section::make(__('app.consultation_evaluation'))
                    ->visible(fn () => auth()->user()->hasPermissionTo('view evaluations') && !auth()->user()->hasPermissionTo('create evaluations') && !auth()->user()->hasPermissionTo('edit evaluations'))
                    ->schema([
                        Forms\Components\Placeholder::make('titre_display')
                            ->label(__('app.titre'))
                            ->content(fn ($record) => $record->titre ?: new \Illuminate\Support\HtmlString('<em class="text-gray-500">Sans titre</em>')),
                            
                        Forms\Components\Placeholder::make('type_display')
                            ->label(__('app.type'))
                            ->content(fn ($record) => new \Illuminate\Support\HtmlString('<span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-700/10">' . ucfirst($record->type) . '</span>')),
                            
                        Forms\Components\Placeholder::make('matiere_display')
                            ->label(__('app.matiere'))
                            ->content(fn ($record) => $record->matiere?->nom_matiere ?: '-'),
                            
                        Forms\Components\Placeholder::make('classe_display')
                            ->label(__('app.classe'))
                            ->content(fn ($record) => $record->classe?->nom_classe ?: '-'),
                            
                        Forms\Components\Placeholder::make('note_max_display')
                            ->label(__('app.note_maximum'))
                            ->content(fn ($record) => new \Illuminate\Support\HtmlString('<span class="text-lg font-semibold text-green-600">' . $record->note_max . '</span> points')),
                            
                        Forms\Components\Placeholder::make('date_display')
                            ->label(__('app.date_evaluation'))
                            ->content(fn ($record) => $record->date ? $record->date->format('d/m/Y') : '-'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titre')
                    ->label(__('app.evaluation'))
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('type')
                    ->label(__('app.type'))
                    ->badge()
                    ->formatStateUsing(fn (?string $state) => match ($state) {
                        'devoir' => __('app.devoir'),
                        'interrogation' => __('app.interrogation'),
                        'examen' => __('app.examen'),
                        'controle' => __('app.controle'),
                        'projet' => __('app.projet'),
                            default => $state ?? __('app.type'),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'examen' => 'danger',
                        'controle' => 'warning',
                        'interrogation' => 'info',
                        'devoir' => 'success',
                        'projet' => 'primary',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('matiere.code_matiere')
                    ->label(__('app.matiere'))
                    ->formatStateUsing(fn ($record) => __("app." . $record->matiere->code_matiere))
                    ->searchable()
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('classe.nom_classe')
                    ->label(__('app.classe'))
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                    
                Tables\Columns\TextColumn::make('date')
                    ->label(__('app.date_evaluation'))
                    ->date('d/m/Y')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('note_max')
                    ->label(__('app.note_maximum'))
                    ->sortable()
                    ->suffix(__('app.point')),
                    
                Tables\Columns\TextColumn::make('notes_count')
                    ->label(__('app.etudiants_notee'))
                    ->counts('notes')
                    ->badge()
                    ->color('success'),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('app.cree_a'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('app.mis_a_jour_le'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label(__('app.type'))
                    ->options([
                        'devoir' => __('app.homework'),
                        'interrogation' => __('app.quiz'),
                        'examen' => __('app.exam'),
                        'controle' => __('app.test'),
                        'projet' => __('app.project'),
                    ]),
                    
                Tables\Filters\SelectFilter::make('id_matiere')
                    ->label(__('app.matiere'))
                    ->relationship('matiere', 'nom_matiere')
                    ->searchable()
                    ->preload(),
                    
                Tables\Filters\SelectFilter::make('id_classe')
                    ->label(__('app.classe'))
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

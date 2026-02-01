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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\Classe;

class EtudiantResource extends Resource
{
    protected static ?string $model = Etudiant::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('app.personnes');
    }

    public static function getNavigationLabel(): string
    {
        return __('app.etudiants');
    }

    public static function getPluralLabel(): string
    {
        return __('app.etudiants');
    }

    public static function getModelLabel(): string
    {
        return __('app.etudiant');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('super_admin') || auth()->user()->can('manage students');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasRole('super_admin') || auth()->user()->can('manage students');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole('super_admin') || auth()->user()->can('manage students');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole('super_admin') || auth()->user()->can('manage students');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('app.informations_personnelles'))
                    ->schema([
                        Forms\Components\TextInput::make('matricule')
                            ->label(__('app.matricule'))
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder(__('app.placeholder_matricule'))
                            ->helperText(__('app.matricule_auto_generated'))
                            ->visibleOn('edit'),
                            
                        Forms\Components\TextInput::make('nom')
                            ->label(__('app.nom'))
                            ->required()
                            ->maxLength(191),
                                    
                        Forms\Components\TextInput::make('prenom')
                            ->label(__('app.prenom'))
                            ->required()
                            ->maxLength(191),
                            
                        Forms\Components\DatePicker::make('date_naissance')
                            ->label(__('app.date_naissance'))
                            ->required()
                            ->maxDate(now()->subYears(5))
                            ->displayFormat('d/m/Y'),
                            
                        Forms\Components\Select::make('genre')
                            ->label(__('app.genre'))
                            ->required()
                            ->options([
                                'M' => __('app.M'),
                                'F' => __('app.F'),
                            ]),
                            
                        Forms\Components\Select::make('id_classe')
                            ->label(__('app.classe'))
                            ->relationship('classe', 'nom_classe')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make(__('app.contact_information'))
                    ->schema([
                        Forms\Components\TextInput::make('telephone')
                            ->label(__('app.telephone'))
                            ->tel()
                            ->maxLength(191),
                            
                        Forms\Components\Textarea::make('adresse')
                            ->label(__('app.adresse'))
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make(__('app.compte_utilisateur'))
                    ->description(__('app.compte_utilisateur_description'))
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label(__('app.email'))
                            ->email()
                            ->maxLength(191)
                            ->helperText(__('app.leave_empty_for_no_account'))
                            ->hiddenOn('view'),
                            
                        Forms\Components\TextInput::make('email_display')
                            ->label(__('app.email'))
                            ->disabled()
                            ->dehydrated(false)
                            ->visibleOn('view')
                            ->default(fn ($record) => $record->user?->email ?? '-'),
                                    
                        Forms\Components\TextInput::make('password')
                            ->label(__('app.password'))
                            ->password()
                            ->revealable()
                            ->maxLength(191)
                            ->helperText(__('app.leave_empty_to_keep_current'))
                            ->hiddenOn('view'),
                                    
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('app.compte_actif'))
                            ->default(true)
                            ->hiddenOn('view'),
                            
                        Forms\Components\Placeholder::make('compte_status')
                            ->label(__('app.statut'))
                            ->content(fn ($record) => $record->user?->is_active 
                                ? new \Illuminate\Support\HtmlString('<span class="text-success-600 font-semibold">' . __('app.actif') . '</span>')
                                : new \Illuminate\Support\HtmlString('<span class="text-danger-600 font-semibold">' . __('app.inactif') . '</span>'))
                            ->visibleOn('view'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('matricule')
                    ->label(__('app.matricule'))
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->badge()
                    ->color('primary'),
                    
                Tables\Columns\TextColumn::make('nom')
                    ->label(__('app.nom'))
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('prenom')
                    ->label(__('app.prenom'))
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('classe.nom_classe')
                    ->label(__('app.classe'))
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                    
                Tables\Columns\TextColumn::make('date_naissance')
                    ->label(__('app.date_naissance'))
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('genre')
                    ->label(__('app.genre'))
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'M' => __('app.M'),
                        'F' => __('app.F'),
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'M' => 'blue',
                        'F' => 'pink',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('telephone')
                    ->label(__('app.telephone'))
                    ->searchable()
                    ->toggleable()
                    ->copyable()
                    ->icon('heroicon-o-phone'),

                Tables\Columns\IconColumn::make('user.is_active')
                    ->label(__('app.compte_actif'))
                    ->boolean()
                    ->sortable()
                    ->toggleable()
                    ->default(false),
                    
                Tables\Columns\TextColumn::make('user.email')
                    ->label(__('app.email'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->copyable()
                    ->icon('heroicon-o-envelope')
                    ->default(__('app.aucun_compte')),
                    
                Tables\Columns\TextColumn::make('notes_count')
                    ->label(__('app.notes'))
                    ->counts('notes')
                    ->badge()
                    ->color('success')
                    ->toggleable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('app.date_creation'))
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_classe')
                    ->label(__('app.classe'))
                    ->relationship('classe', 'nom_classe')
                    ->searchable()
                    ->preload(),
                    
                Tables\Filters\SelectFilter::make('genre')
                    ->label(__('app.genre'))
                    ->options([
                        'M' => __('app.M'),
                        'F' => __('app.F'),
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
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
            'view' => Pages\ViewEtudiant::route('/{record}'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\HasRoleBasedAccess;
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
use Barryvdh\DomPDF\Facade\Pdf;

class EtudePaiementResource extends Resource
{
    use HasRoleBasedAccess;
    
    protected static ?string $model = EtudePaiement::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    
    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('app.gestion_financiere');
    }

    public static function getNavigationLabel(): string
    {
        return __('app.paiements_etudiants');
    }

    public static function getPluralLabel(): string
    {
        return __('app.paiements_etudiants');
    }

    public static function getModelLabel(): string
    {
        return __('app.paiements_etudiants');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasPermissionTo('view payments');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasPermissionTo('create payments');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->hasPermissionTo('edit payments');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->hasPermissionTo('delete payments');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Payment Information')
                    ->visible(fn () => auth()->user()->hasPermissionTo('create payments') || auth()->user()->hasPermissionTo('edit payments'))
                    ->schema([
                        Forms\Components\Select::make('id_etudiant')
                            ->label(__('app.etudiant'))
                            ->relationship('etudiant', 'matricule')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->nom} {$record->prenom} ({$record->matricule})")
                            ->required()
                            ->searchable(['matricule'])
                            ->preload(),
                            
                        Forms\Components\Select::make('typepaye')
                            ->label(__('app.type_paiement'))
                            ->required()
                            ->options([
                                'scolarite' => __('app.scolarite'),
                                'inscription' => __('app.inscription'),
                                'examen' => __('app.examen'),
                                'uniforme' => __('app.uniforme'),
                                'transport' => __('app.transport'),
                                'cantine' => __('app.cantine'),
                                'autre' => __('app.autre'),
                            ]),
                            
                        Forms\Components\TextInput::make('montant')
                            ->label(__('app.montant'))
                            ->required()
                            ->numeric()
                            ->prefix(config('app.currency', 'MRU'))
                            ->minValue(0)
                            ->default(0.00),
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Payment Status')
                    ->visible(fn () => auth()->user()->hasPermissionTo('create payments') || auth()->user()->hasPermissionTo('edit payments'))
                    ->schema([
                        Forms\Components\Select::make('statut')
                            ->label(__('app.statut'))
                            ->required()
                            ->options([
                                'pending' => __('app.en_attente'),
                                'paid' => __('app.paye'),
                                'partial' => __('app.partiel'),
                                'cancelled' => __('app.annule'),
                            ])
                            ->default('pending'),
                            
                        Forms\Components\DatePicker::make('date_paiement')
                            ->label(__('app.date_paiement'))
                            ->displayFormat('d/m/Y')
                            ->default(now()),
                    ])
                    ->columns(2),
                    
                // Read-only payment summary for users with view-only permissions
                Forms\Components\Section::make(__('app.payment_summary'))
                    ->visible(fn () => auth()->user()->hasPermissionTo('view payments') && !auth()->user()->hasPermissionTo('create payments') && !auth()->user()->hasPermissionTo('edit payments'))
                    ->schema([
                        Forms\Components\Placeholder::make('etudiant_info')
                            ->label(__('app.etudiant'))
                            ->content(fn ($record) => $record->etudiant 
                                ? new \Illuminate\Support\HtmlString('<strong>' . $record->etudiant->nom . ' ' . $record->etudiant->prenom . '</strong><br><small>' . $record->etudiant->matricule . '</small>')
                                : '-'),
                                
                        Forms\Components\Placeholder::make('type_paiement')
                            ->label(__('app.type_paiement'))
                            ->content(fn ($record) => new \Illuminate\Support\HtmlString('<span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-700/10">' . ucfirst($record->typepaye) . '</span>')),
                            
                        Forms\Components\Placeholder::make('montant_display')
                            ->label(__('app.montant'))
                            ->content(fn ($record) => new \Illuminate\Support\HtmlString('<span class="text-lg font-semibold text-green-600">' . config('app.currency', 'MRU') . ' ' . number_format($record->montant, 2) . '</span>')),
                            
                        Forms\Components\Placeholder::make('statut_display')
                            ->label(__('app.statut'))
                            ->content(fn ($record) => match($record->statut) {
                                'paid' => new \Illuminate\Support\HtmlString('<span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium bg-green-50 text-green-700 ring-1 ring-inset ring-green-700/10">✅ ' . __('app.paye') . '</span>'),
                                'partial' => new \Illuminate\Support\HtmlString('<span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium bg-yellow-50 text-yellow-700 ring-1 ring-inset ring-yellow-700/10">⚠️ ' . __('app.partiel') . '</span>'),
                                'pending' => new \Illuminate\Support\HtmlString('<span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-700/10">⏳ ' . __('app.en_attente') . '</span>'),
                                'cancelled' => new \Illuminate\Support\HtmlString('<span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium bg-red-50 text-red-700 ring-1 ring-inset ring-red-700/10">❌ ' . __('app.annule') . '</span>'),
                                default => new \Illuminate\Support\HtmlString('<span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium bg-gray-50 text-gray-700 ring-1 ring-inset ring-gray-700/10">' . __('app.unknown') . '</span>'),
                            }),
                            
                        Forms\Components\Placeholder::make('date_paiement_display')
                            ->label(__('app.date_paiement'))
                            ->content(fn ($record) => $record->date_paiement ? $record->date_paiement->format('d/m/Y') : '-'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('etudiant.matricule')
                    ->label(__('app.matricule'))
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('etudiant.nom')
                    ->label(__('app.etudiant'))
                    ->formatStateUsing(fn ($record) => "{$record->etudiant->nom} {$record->etudiant->prenom}")
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('etudiant', function (Builder $query) use ($search) {
                            $query->where('nom', 'like', "%{$search}%")
                                ->orWhere('prenom', 'like', "%{$search}%");
                        });
                    })
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('typepaye')
                    ->label(__('app.type_paiement'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'scolarite' => 'primary',
                        'inscription' => 'success',
                        'examen' => 'warning',
                        'transport' => 'info',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('montant')
                    ->label(__('app.montant'))
                    ->money(config('app.currency', 'MRU'),locale: 'en')
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money(config('app.currency', 'MRU'),locale: 'en')
                            ->visible(fn () => auth()->user()->hasRole(['admin', 'super_admin'])),
                    ]),
                    
                Tables\Columns\TextColumn::make('statut')
                    ->label(__('app.statut'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'partial' => 'warning',
                        'pending' => 'info',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('date_paiement')
                    ->label(__('app.date_paiement'))
                    ->date('d/m/Y')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('app.cree_a'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_etudiant')
                    ->label(__('app.etudiant'))
                    ->relationship('etudiant', 'matricule')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->nom} {$record->prenom} ({$record->matricule})")
                    ->searchable()
                    ->preload(),
                    
                Tables\Filters\SelectFilter::make('statut')
                    ->label(__('app.statut'))
                    ->options([
                        'pending' => __('app.pending'),
                        'paid' => __('app.paid'),
                        'partial' => __('app.partial'),
                        'cancelled' => __('app.cancelled'),
                    ]),
                    
                Tables\Filters\SelectFilter::make('typepaye')
                    ->label(__('app.type_paiement'))
                    ->options([
                        'scolarite' => __('app.scolarite'),
                        'inscription' => __('app.inscription'),
                        'examen' => __('app.examen'),
                        'uniforme' => __('app.uniforme'),
                        'transport' => __('app.transport'),
                        'cantine' => __('app.cantine'),
                        'autre' => __('app.autre'),
                    ]),
                    
                Tables\Filters\Filter::make('date_paiement')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label(__('app.from_date')),
                        Forms\Components\DatePicker::make('until')
                            ->label(__('app.until_date')),
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
                Tables\Actions\Action::make('printReceipt')
                    ->label(__('app.imprimer_recu'))
                    ->icon('heroicon-o-printer')
                    ->color('info')
                    ->action(function (EtudePaiement $record) {
                        $record->load(['etudiant', 'etudiant.classe']);
                        
                        $pdf = Pdf::loadView('pdf.receipt', [
                            'payment' => $record,
                        ])->setPaper('a5', 'landscape');

                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->output();
                        }, __("app.recu_paiement")."_{$record->id_paiements}.pdf");
                    }),
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

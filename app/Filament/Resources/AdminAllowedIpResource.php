<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminAllowedIpResource\Pages;
use App\Models\AdminAllowedIp;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AdminAllowedIpResource extends Resource
{
    protected static ?string $model = AdminAllowedIp::class;

    protected static ?string $navigationIcon = 'heroicon-o-finger-print';

    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return __('app.systeme');
    }

    public static function getNavigationLabel(): string
    {
        return __('app.ip_whitelist');
    }

    public static function getPluralLabel(): string
    {
        return __('app.ip_whitelist');
    }

    public static function getModelLabel(): string
    {
        return __('app.ip_autorisee');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('super_admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('app.ip_autorisee'))
                    ->schema([
                        Forms\Components\TextInput::make('ip_address')
                            ->label(__('app.ip_address'))
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('127.0.0.1')
                            ->ipv4() // Or ipv6() depending on needs, ipv4 is safer default validation
                            ->maxLength(45),
                        
                        Forms\Components\TextInput::make('label')
                            ->label(__('app.label_ip'))
                            ->placeholder(__('app.placeholder_label_ip'))
                            ->maxLength(191),
                            
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('app.actif'))
                            ->default(true),

                        Forms\Components\Hidden::make('added_by')
                            ->default(fn () => auth()->user()->profile_id),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->with('addedBy'))
            ->columns([
                Tables\Columns\TextColumn::make('ip_address')
                    ->label(__('app.ip_address'))
                    ->searchable()
                    ->copyable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('label')
                    ->label(__('app.label_ip'))
                    ->searchable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('app.actif'))
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('addedBy')
                    ->label(__('app.added_by'))
                    ->getStateUsing(fn ($record) => $record->addedBy ? "{$record->addedBy->nom} {$record->addedBy->prenom}" : '-')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('app.time'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label(__('app.actif'))
                    ->placeholder(__('app.all'))
                    ->trueLabel(__('app.actif'))
                    ->falseLabel(__('app.inactif')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdminAllowedIps::route('/'),
            'create' => Pages\CreateAdminAllowedIp::route('/create'),
            'edit' => Pages\EditAdminAllowedIp::route('/{record}/edit'),
        ];
    }
}

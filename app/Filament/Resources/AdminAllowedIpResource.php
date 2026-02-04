<?php

namespace App\Filament\Resources;

use App\Filament\Concerns\HasRoleBasedAccess;
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
    use HasRoleBasedAccess;
    
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
        return auth()->user()->hasPermissionTo('manage system settings');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasPermissionTo('manage system settings');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->hasPermissionTo('manage system settings');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->hasPermissionTo('manage system settings');
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
                        
                        Forms\Components\Textarea::make('description')
                            ->label(__('app.description'))
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ip_address')
                    ->label(__('app.ip_address'))
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                    
                Tables\Columns\TextColumn::make('description')
                    ->label(__('app.description'))
                    ->limit(50)
                    ->tooltip(function (AdminAllowedIp $record): ?string {
                        return $record->description;
                    }),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('app.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('app.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListAdminAllowedIps::route('/'),
            'create' => Pages\CreateAdminAllowedIp::route('/create'),
            'edit' => Pages\EditAdminAllowedIp::route('/{record}/edit'),
        ];
    }
}

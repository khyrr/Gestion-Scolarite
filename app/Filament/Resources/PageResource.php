<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return __('app.systeme');
    }

    public static function getNavigationLabel(): string
    {
        return __('app.pages');
    }

    public static function getPluralLabel(): string
    {
        return __('app.pages');
    }

    public static function getModelLabel(): string
    {
        return __('app.page');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasPermissionTo('manage pages') || auth()->user()->hasRole('super_admin');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasPermissionTo('manage pages') || auth()->user()->hasRole('super_admin');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->hasPermissionTo('manage pages') || auth()->user()->hasRole('super_admin');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->hasPermissionTo('manage pages') || auth()->user()->hasRole('super_admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('app.page_information'))
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('app.title'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $context, $state, Forms\Set $set) => $context === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),

                        Forms\Components\TextInput::make('slug')
                            ->label(__('app.slug'))
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->rules(['alpha_dash'])
                            ->helperText(__('app.slug_helper')),

                        Forms\Components\Textarea::make('content')
                            ->label(__('app.content'))
                            ->rows(10)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('app.page_settings'))
                    ->schema([
                        Forms\Components\Toggle::make('is_enabled')
                            ->label(__('app.page_enabled'))
                            ->helperText(__('app.page_enabled_helper'))
                            ->default(true),

                        Forms\Components\Toggle::make('is_public')
                            ->label(__('app.page_public'))
                            ->helperText(__('app.page_public_helper'))
                            ->default(true),

                        Forms\Components\TextInput::make('sort_order')
                            ->label(__('app.sort_order'))
                            ->numeric()
                            ->default(0)
                            ->helperText(__('app.sort_order_helper')),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('app.title'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('slug')
                    ->label(__('app.slug'))
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\IconColumn::make('is_enabled')
                    ->label(__('app.enabled'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_public')
                    ->label(__('app.public'))
                    ->boolean()
                    ->trueIcon('heroicon-o-globe-alt')
                    ->falseIcon('heroicon-o-eye-slash')
                    ->trueColor('info')
                    ->falseColor('warning')
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('app.order'))
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('app.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('app.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_enabled')
                    ->label(__('app.enabled'))
                    ->placeholder(__('app.all'))
                    ->trueLabel(__('app.enabled_only'))
                    ->falseLabel(__('app.disabled_only')),

                Tables\Filters\TernaryFilter::make('is_public')
                    ->label(__('app.public'))
                    ->placeholder(__('app.all'))
                    ->trueLabel(__('app.public_only'))
                    ->falseLabel(__('app.private_only')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                
                Tables\Actions\Action::make('view_page')
                    ->label(__('app.view_page'))
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn (Page $record): string => route('page.show', $record->slug))
                    ->openUrlInNewTab()
                    ->visible(fn (Page $record): bool => $record->is_enabled && $record->is_public),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                    BulkAction::make('enable')
                        ->label(__('app.enable'))
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn (Collection $records) => $records->each->update(['is_enabled' => true]))
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('disable')
                        ->label(__('app.disable'))
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn (Collection $records) => $records->each->update(['is_enabled' => false]))
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('make_public')
                        ->label(__('app.make_public'))
                        ->icon('heroicon-o-globe-alt')
                        ->color('info')
                        ->action(fn (Collection $records) => $records->each->update(['is_public' => true]))
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('make_private')
                        ->label(__('app.make_private'))
                        ->icon('heroicon-o-eye-slash')
                        ->color('warning')
                        ->action(fn (Collection $records) => $records->each->update(['is_public' => false]))
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc');
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'view' => Pages\ViewPage::route('/{record}'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
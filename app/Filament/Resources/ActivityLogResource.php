<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use Spatie\Activitylog\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ActivityLogResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    
    protected static ?string $navigationGroup = 'System';
    
    protected static ?int $navigationSort = 3;
    
    protected static ?string $navigationLabel = 'Activity Logs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Read-only resource - no form needed
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('log_name')
                    ->label('Log Type')
                    ->badge()
                    ->color('primary')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('description')
                    ->label('Action')
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('subject_type')
                    ->label('Model')
                    ->formatStateUsing(fn ($state) => class_basename($state))
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('subject_id')
                    ->label('Record ID')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('causer.name')
                    ->label('User')
                    ->searchable()
                    ->sortable()
                    ->default('System'),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->since()
                    ->description(fn ($record) => $record->created_at->format('d/m/Y H:i:s')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('description')
                    ->label('Action')
                    ->options([
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                    ]),
                    
                Tables\Filters\SelectFilter::make('subject_type')
                    ->label('Model Type')
                    ->options(function () {
                        return Activity::distinct()
                            ->pluck('subject_type')
                            ->mapWithKeys(fn ($type) => [$type => class_basename($type)])
                            ->toArray();
                    }),
                    
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('From Date'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Until Date'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
                            ->when($data['until'], fn ($q, $date) => $q->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modalContent(fn ($record) => view('filament.resources.activity-log.view', ['record' => $record])),
            ])
            ->bulkActions([
                // No bulk actions for logs - read-only
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s'); // Auto-refresh every 30 seconds
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityLogs::route('/'),
        ];
    }
    
    public static function canCreate(): bool
    {
        return false; // Read-only
    }
    
    public static function canEdit($record): bool
    {
        return false; // Read-only
    }
    
    public static function canDelete($record): bool
    {
        return false; // Read-only
    }
    
    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'admin']);
    }
}

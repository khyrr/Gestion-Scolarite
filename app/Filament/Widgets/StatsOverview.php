<?php

namespace App\Filament\Widgets;

use App\Models\Classe;
use App\Models\Cours;
use App\Models\Enseignant;
use App\Models\Etudiant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make(__('app.total_etudiants'), Etudiant::count())
                ->description(__('app.etudiants'))
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),
            Stat::make(__('app.total_enseignants'), Enseignant::count())
                ->description(__('app.enseignants'))
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),
            Stat::make(__('app.total_classes'), Classe::count())
                ->description(__('app.classes'))
                ->descriptionIcon('heroicon-m-home-modern')
                ->color('warning'),
            Stat::make(__('app.total_cours'), Cours::count())
                ->description(__('app.cours'))
                ->descriptionIcon('heroicon-m-book-open')
                ->color('danger'),
        ];
    }
}

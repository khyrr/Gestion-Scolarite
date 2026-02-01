<?php

namespace App\Filament\Widgets;

use App\Models\Classe;
use Filament\Widgets\ChartWidget;

class StudentsByClassChart extends ChartWidget
{
    protected static ?int $sort = 3;

    public function getHeading(): string
    {
        return __('app.etudiants_par_classe');
    }

    protected function getData(): array
    {
        $classes = Classe::withCount('etudiants')->get();

        return [
            'datasets' => [
                [
                    'label' => __('app.etudiants'),
                    'data' => $classes->pluck('etudiants_count')->toArray(),
                    'backgroundColor' => '#FFCE56',
                    'borderColor' => '#FFCE56',
                ],
            ],
            'labels' => $classes->pluck('nom_classe')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

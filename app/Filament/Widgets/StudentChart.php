<?php

namespace App\Filament\Widgets;

use App\Models\Etudiant;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class StudentChart extends ChartWidget
{
    protected static ?int $sort = 2;

    // protected int | string | array $columnSpan = [
    //     'xl' => 0.5,
    //     'lg' => 0.5,

    // ];
    // protected ?string $maxWidth = '2xl';

    public function getHeading(): string
    {
        return __('app.repartition_etudiants');
    }

    protected function getData(): array
    {
        $data = Etudiant::select('genre', DB::raw('count(*) as total'))
            ->groupBy('genre')
            ->pluck('total', 'genre')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => __('app.etudiants'),
                    'data' => [
                        $data['M'] ?? 0,
                        $data['F'] ?? 0,
                    ],
                    'backgroundColor' => [
                        '#36A2EB', // Blue for Men
                        '#FF6384', // Pink for Women
                    ],
                ],
            ],
            'labels' => [
                __('app.M'),
                __('app.F'),
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}

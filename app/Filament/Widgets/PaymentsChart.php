<?php

namespace App\Filament\Widgets;

use App\Models\EtudePaiement;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class PaymentsChart extends ChartWidget
{
    protected static ?int $sort = 5;

    public static function canView(): bool
    {
        return auth()->user()->hasRole(['super_admin', 'admin', 'accountant']);
    }

    public function getHeading(): string
    {
        return __('app.flux_financier');
    }

    protected function getData(): array
    {
        // For simplicity without installing trend package, let's use standard group by
        $data = EtudePaiement::selectRaw('SUM(montant) as aggregate, DATE_FORMAT(date_paiement, "%Y-%m") as date')
            ->where('date_paiement', '>=', now()->subMonths(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => __('app.paiements'),
                    'data' => $data->pluck('aggregate')->toArray(),
                    'fill' => 'start',
                    'borderColor' => '#4BC0C0',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                ],
            ],
            'labels' => $data->pluck('date')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

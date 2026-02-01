<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Actions\Action;
use App\Models\Classe;
use App\Models\Cours;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms;
use Illuminate\Support\Facades\Blade;

class Dashboard extends BaseDashboard
{
    public function getTitle(): string | Htmlable
    {
        return __('app.tableau_de_bord');
    }

    public static function getNavigationLabel(): string
    {
        return __('app.tableau_de_bord');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('printTimetable')
                ->label(__('app.emploi_temps'))
                ->icon('heroicon-o-calendar-days')
                ->color('info')
                ->form([
                    Forms\Components\Select::make('id_classe')
                        ->label(__('app.classe'))
                        ->options(Classe::pluck('nom_classe', 'id_classe'))
                        ->required()
                        ->searchable()
                        ->live(),
                    Forms\Components\Placeholder::make('preview')
                        ->label('')
                        ->content(function (Forms\Get $get) {
                            $classeId = $get('id_classe');
                            if (!$classeId) {
                                return null;
                            }

                            $classe = Classe::find($classeId);
                            $courses = Cours::where('id_classe', $classeId)
                                ->with(['matiere', 'enseignant'])
                                ->get();

                            return view('filament.pages.timetable-preview', [
                                'classe' => $classe,
                                'courses' => $courses,
                            ]);
                        }),
                ])
                ->modalWidth('7xl')
                ->modalHeading(__('app.emploi_temps'))
                ->modalSubmitActionLabel(__('app.export_pdf'))
                ->action(function (array $data) {
                    $classe = Classe::find($data['id_classe']);
                    $courses = Cours::where('id_classe', $data['id_classe'])
                        ->with(['matiere', 'enseignant'])
                        ->get();

                    $pdf = Pdf::loadView('pdf.timetable', [
                        'classe' => $classe,
                        'courses' => $courses,
                    ])->setPaper('a4', 'portrait');

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, "emploi_du_temps_{$classe->nom_classe}.pdf");
                }),
        ];
    }
}

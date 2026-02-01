<?php

namespace App\Filament\Resources\CoursResource\Pages;

use App\Filament\Resources\CoursResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms;
use App\Models\Classe;
use App\Models\Cours;
use Barryvdh\DomPDF\Facade\Pdf;

class ListCours extends ListRecords
{
    protected static string $resource = CoursResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('printTimetable')
                ->label(__('app.imprimer_emploi_temps'))
                ->icon('heroicon-o-printer')
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
                                ->with(['matiere', 'enseignant.user'])
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
                        ->with(['matiere', 'enseignant.user'])
                        ->get();

                    $pdf = Pdf::loadView('pdf.timetable', [
                        'classe' => $classe,
                        'courses' => $courses,
                    ])->setPaper('a4', 'portrait');

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, "emploi_du_temps_{$classe->nom_classe}.pdf");
                }),
            Actions\CreateAction::make(),
        ];
    }
}

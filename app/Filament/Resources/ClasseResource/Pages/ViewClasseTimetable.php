<?php

namespace App\Filament\Resources\ClasseResource\Pages;

use App\Filament\Resources\ClasseResource;
use App\Models\Classe;
use App\Models\Cours;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;

class ViewClasseTimetable extends ViewRecord
{
    protected static string $resource = ClasseResource::class;

    protected static string $view = 'filament.resources.classe-resource.pages.view-classe-timetable';

    public function getTitle(): string
    {
        return __('app.emploi_temps') . ' - ' . $this->record->nom_classe;
    }

    public static function getNavigationLabel(): string
    {
        return __('app.emploi_temps');
    }

    protected function getActions(): array
    {
        return [
            Action::make('exportPdf')
                ->label(__('app.export_pdf'))
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    $classe = $this->record;
                    $courses = Cours::where('id_classe', $classe->id_classe)
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

    protected function getViewData(): array
    {
        $classe = $this->record;
        $courses = Cours::where('id_classe', $classe->id_classe)
            ->with(['matiere', 'enseignant'])
            ->get();

        return [
            'classe' => $classe,
            'courses' => $courses,
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->hasRole('super_admin') || 
               auth()->user()->hasRole(['teacher', 'enseignant']);
    }
}
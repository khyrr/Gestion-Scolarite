<?php

namespace App\Filament\Resources\CoursResource\Pages;

use App\Filament\Resources\CoursResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms;
use App\Models\Classe;
use App\Models\Cours;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Filament\Concerns\HasRoleBasedAccess;

class ListCours extends ListRecords
{
    use HasRoleBasedAccess;
    
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
                        ->options(function () {
                            return static::applyRoleBasedRelationScope(Classe::query(), [
                                'classColumn' => 'id_classe'
                            ])->pluck('nom_classe', 'id_classe');
                        })
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
                            $query = Cours::where('id_classe', $classeId)
                                ->with(['matiere', 'enseignant.user']);
                            
                            // Apply RBAC filtering
                            $user = auth()->user();
                            if (!($user->hasRole('super_admin') || 
                                  $user->hasPermissionTo('manage timetables') || 
                                  $user->hasPermissionTo('manage classes'))) {
                                $enseignant = $user->profile;
                                if ($enseignant) {
                                    $query->where('id_enseignant', $enseignant->id_enseignant);
                                }
                            }
                            
                            $courses = $query->get();

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
                    $query = Cours::where('id_classe', $data['id_classe'])
                        ->with(['matiere', 'enseignant.user']);
                    
                    // Apply RBAC filtering
                    $user = auth()->user();
                    if (!($user->hasRole('super_admin') || 
                          $user->hasPermissionTo('manage timetables') || 
                          $user->hasPermissionTo('manage classes'))) {
                        $enseignant = $user->profile;
                        if ($enseignant) {
                            $query->where('id_enseignant', $enseignant->id_enseignant);
                        }
                    }
                    
                    $courses = $query->get();

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

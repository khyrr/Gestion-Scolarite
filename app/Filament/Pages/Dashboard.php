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
use Filament\Facades\Filament;
use App\Filament\Concerns\HasRoleBasedAccess;

class Dashboard extends BaseDashboard
{

    use HasRoleBasedAccess;

    public static function canAccess(): bool
    {
        $user = auth()->user();
        
        // Allow access for administrative roles and teachers
        return $user->hasRole(['super_admin', 'admin', 'director', 'academic_coordinator', 'teacher', 'secretary', 'accountant']);
    }
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
        $user = auth()->user();
        
        // Only admins and teachers should see dashboard actions
        if (!$user->hasRole(['super_admin', 'admin', 'director', 'academic_coordinator', 'teacher'])) {
            return [];
        }
        
        return [
            Action::make('printTimetable')
                ->label(__('app.emploi_temps'))
                ->icon('heroicon-o-calendar-days')
                ->color('info')
                ->form([
                    Forms\Components\Select::make('id_classe')
                        ->label(__('app.classe'))
                        ->options(function () {
                            $user = auth()->user();
                            
                            // Admins see all classes
                            if ($user->hasRole(['super_admin', 'admin', 'director'])) {
                                return Classe::pluck('nom_classe', 'id_classe');
                            }
                            
                            // Teachers see only their classes
                            if ($user->hasRole('teacher')) {
                                $enseignant = $user->profile;
                                if ($enseignant) {
                                    return $enseignant->classes()->pluck('nom_classe', 'classes.id_classe');
                                }
                            }
                            
                            return [];
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
                                ->with(['matiere', 'enseignant']);
                            
                            // Apply RBAC filtering
                            $user = auth()->user();
                            if (!($user->hasRole('super_admin') || 
                                  $user->hasPermissionTo('timetable.manage') || 
                                  $user->hasPermissionTo('class.manage'))) {
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
                        ->with(['matiere', 'enseignant']);
                    
                    // Apply RBAC filtering
                    $user = auth()->user();
                    if (!($user->hasRole('super_admin') || 
                          $user->hasPermissionTo('timetable.manage') || 
                          $user->hasPermissionTo('class.manage'))) {
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
        ];
    }

    public function getWidgets(): array
    {
        $user = auth()->user();
        
        if ($user && $user->hasRole('teacher')) {
            // Teacher widgets
            return [
                \App\Filament\Widgets\TeacherStatsOverview::class,
                \App\Filament\Widgets\TeacherTodaySchedule::class,
                \App\Filament\Widgets\TeacherUpcomingEvaluations::class,
                \App\Filament\Widgets\TeacherRecentNotes::class,
                \App\Filament\Widgets\TeacherStudentPerformance::class,
                \App\Filament\Widgets\TeacherStudentsByClass::class,
            ];
        }
        
        if ($user && $user->hasRole('secretary')) {
            // Secretary widgets - focused on student administration
            return [
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\StudentsByClassChart::class,
                \App\Filament\Widgets\DailyScheduleWidget::class,
                \App\Filament\Widgets\StudentChart::class,
            ];
        }
        
        if ($user && $user->hasRole('accountant')) {
            // Accountant widgets - focused on financial data
            return [
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\PaymentsChart::class,
                \App\Filament\Widgets\StudentsByClassChart::class,
            ];
        }
        
        // Admin widgets (super_admin, admin, director, academic_coordinator)
        return [
            \App\Filament\Widgets\StatsOverview::class,
            \App\Filament\Widgets\StudentChart::class,
            \App\Filament\Widgets\StudentsByClassChart::class,
            \App\Filament\Widgets\DailyScheduleWidget::class,
            \App\Filament\Widgets\ActivityTimeline::class,
            \App\Filament\Widgets\PaymentsChart::class,
        ];
    }

    public function getColumns(): int|string|array
    {
        return 2;
    }
}

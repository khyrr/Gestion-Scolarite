<?php

namespace App\Services;

use App\Models\Cours;
use App\Models\Classe;

class CourseService
{
    /**
     * Get all data needed for the schedule/timetable view
     */
    public function getScheduleData()
    {
        // Get all classes
        $classes = Classe::all();

        // Get all courses with relationships
        $allCours = Cours::with(['classe', 'matiere', 'enseignant'])->get();

        // Get unique time slots dynamically from existing courses
        $timeSlots = Cours::select('date_debut', 'date_fin')
            ->distinct()
            ->orderBy('date_debut')
            ->get()
            ->map(function ($slot) {
                return [
                    'debut' => date('H:i', strtotime($slot->date_debut)),
                    'fin' => date('H:i', strtotime($slot->date_fin))
                ];
            })
            ->unique()
            ->values();

        // Days of the week
        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'];

        // Organize courses by class and time
        $schedule = [];
        foreach ($classes as $classe) {
            $schedule[$classe->id_classe] = [];
            foreach ($timeSlots as $slot) {
                $schedule[$classe->id_classe][$slot['debut'] . '-' . $slot['fin']] = [];
                foreach ($jours as $jour) {
                    $course = $allCours->where('id_classe', $classe->id_classe)
                        ->where('jour', $jour)
                        ->filter(function ($c) use ($slot) {
                            $debut = date('H:i', strtotime($c->date_debut));
                            $fin = date('H:i', strtotime($c->date_fin));
                            return $debut == $slot['debut'] && $fin == $slot['fin'];
                        })
                        ->first();

                    $schedule[$classe->id_classe][$slot['debut'] . '-' . $slot['fin']][$jour] = $course;
                }
            }
        }

        return compact('classes', 'schedule', 'timeSlots', 'jours');
    }
}

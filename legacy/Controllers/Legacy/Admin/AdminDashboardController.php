<?php

namespace App\Http\Controllers\Legacy\Admin;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity as ActivityModel;
use App\Models\Etudiant;
use App\Models\Enseignant;
use App\Models\Classe;
use App\Models\Cours;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'students' => Etudiant::count(),
            'teachers' => Enseignant::count(),
            'classes' => Classe::count(),
            'courses' => Cours::count(),
        ];

        $recentLogs = ActivityModel::latest()
            ->take(5)
            ->get()
            ->map(fn (ActivityModel $r) => (object) [
                'id' => $r->id,
                'description' => $r->description,
                'causer' => $r->causer?->name ?? class_basename($r->causer_type) . " #{$r->causer_id}",
                'created_at' => $r->created_at,
            ]);

        return view('old_admin_pages.admin.dashboard', compact('recentLogs', 'stats'));
    }
}

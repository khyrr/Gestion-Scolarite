<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
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

        $recentLogs = ActivityLog::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('recentLogs', 'stats'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $recentLogs = ActivityLog::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('recentLogs'));
    }
}

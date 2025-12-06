<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Only super_admin can access the audit UI
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if (! $user || ($user->role ?? '') !== 'super_admin') {
                abort(403, 'Only super administrators can access logs.');
            }
            return $next($request);
        });
    }

    /** Index and filter logs */
    public function index(Request $request)
    {
        $query = ActivityLog::query();

        if ($userType = $request->query('user_type')) {
            $query->where('user_type', $userType);
        }

        if ($action = $request->query('action')) {
            $query->where('action', $action);
        }

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('user_agent', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%");
            });
        }

        if ($from = $request->query('from')) {
            $query->whereDate('created_at', '>=', $from);
        }

        if ($to = $request->query('to')) {
            $query->whereDate('created_at', '<=', $to);
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(25)->withQueryString();

        return view('admin.logs.index', compact('logs'));
    }

    /** Export logs as CSV */
    public function export(Request $request): StreamedResponse
    {
        $fileName = 'activity-logs-' . now()->format('Ymd_His') . '.csv';

        $callback = function () use ($request) {
            $handle = fopen('php://output', 'w');

            // header row
            fputcsv($handle, ['id','user_type','user_id','action','resource','resource_id','description','changes','ip_address','user_agent','created_at']);

            $query = ActivityLog::query();

            // apply same filters as index
            foreach (['user_type','action','search','from','to'] as $p) {
                $v = $request->query($p);
                if (! $v) continue;
                if ($p === 'search') {
                    $query->where(function ($q) use ($v) {
                        $q->where('description', 'like', "%{$v}%")
                          ->orWhere('user_agent', 'like', "%{$v}%")
                          ->orWhere('ip_address', 'like', "%{$v}%");
                    });
                } elseif ($p === 'from') {
                    $query->whereDate('created_at', '>=', $v);
                } elseif ($p === 'to') {
                    $query->whereDate('created_at', '<=', $v);
                } else {
                    $query->where($p, $v);
                }
            }

            // stream rows
            ActivityLog::cursor()->filter(function ($log) use ($query) {
                return $query->where('id', $log->id)->exists();
            });

            // Instead of the inefficient filter above, just iterate results with chunk
            $query->orderBy('created_at','desc')->chunk(200, function ($rows) use ($handle) {
                foreach ($rows as $r) {
                    fputcsv($handle, [
                        $r->id,
                        $r->user_type,
                        $r->user_id,
                        $r->action,
                        $r->resource,
                        $r->resource_id,
                        $r->description,
                        is_array($r->changes) ? json_encode($r->changes) : $r->changes,
                        $r->ip_address,
                        $r->user_agent,
                        $r->created_at,
                    ]);
                }
            });

            fclose($handle);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ]);
    }
}

<?php

namespace App\Http\Controllers\Legacy\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity as ActivityModel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Only super_admin can access the audit UI
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if (! $user || ! $user->hasRole('super_admin')) {
                abort(403, 'Only super administrators can access logs.');
            }
            return $next($request);
        });
    }

    /** Index and filter logs */
    public function index(Request $request)
    {
        $query = ActivityModel::query();

        if ($userType = $request->query('user_type')) {
            // match by class basename or containing string
            $query->where('causer_type', 'like', "%{$userType}%");
        }

        if ($action = $request->query('action')) {
            $query->where('description', 'like', "%{$action}%");
        }

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('properties->user_agent', 'like', "%{$search}%")
                  ->orWhere('properties->ip', 'like', "%{$search}%");
            });
        }

        if ($from = $request->query('from')) {
            $query->whereDate('created_at', '>=', $from);
        }

        if ($to = $request->query('to')) {
            $query->whereDate('created_at', '<=', $to);
        }

        $paginator = $query->orderBy('created_at', 'desc')->paginate(25)->withQueryString();

        // Normalize to the old shape expected by the view
        $logs = $paginator->setCollection(
            $paginator->getCollection()->map(function (ActivityModel $r) {
                return (object) [
                    'id' => $r->id,
                    'user_type' => $r->causer_type ? class_basename($r->causer_type) : ($r->properties['resource'] ?? null),
                    'user_id' => $r->causer_id,
                    'action' => $r->description,
                    'resource' => $r->subject_type ? class_basename($r->subject_type) : ($r->properties['resource'] ?? null),
                    'resource_id' => $r->subject_id ?? $r->properties['resource_id'] ?? null,
                    'description' => $r->description,
                    'changes' => $r->properties['changes'] ?? null,
                    'ip_address' => $r->properties['ip'] ?? null,
                    'user_agent' => $r->properties['user_agent'] ?? null,
                    'created_at' => $r->created_at,
                ];
            })
        );

        return view('old_admin_pages.admin.logs.index', compact('logs'));
    }

    /** Export logs as CSV */
    public function export(Request $request): StreamedResponse
    {
        $fileName = 'activity-logs-' . now()->format('Ymd_His') . '.csv';

        $callback = function () use ($request) {
            $handle = fopen('php://output', 'w');

            // header row
            fputcsv($handle, ['id','user_type','user_id','action','resource','resource_id','description','changes','ip_address','user_agent','created_at']);

            $query = ActivityModel::query();

            // apply same filters as index
            if ($v = $request->query('user_type')) {
                $query->where('causer_type', 'like', "%{$v}%");
            }
            if ($v = $request->query('action')) {
                $query->where('description', 'like', "%{$v}%");
            }
            if ($v = $request->query('search')) {
                $query->where(function ($q) use ($v) {
                    $q->where('description', 'like', "%{$v}%")
                      ->orWhere('properties->user_agent', 'like', "%{$v}%")
                      ->orWhere('properties->ip', 'like', "%{$v}%");
                });
            }
            if ($v = $request->query('from')) {
                $query->whereDate('created_at', '>=', $v);
            }
            if ($v = $request->query('to')) {
                $query->whereDate('created_at', '<=', $v);
            }

            // stream rows (chunked)
            $query->orderBy('created_at','desc')->chunk(200, function ($rows) use ($handle) {
                foreach ($rows as $r) {
                    fputcsv($handle, [
                        $r->id,
                        $r->causer_type ? class_basename($r->causer_type) : ($r->properties['resource'] ?? null),
                        $r->causer_id,
                        $r->description,
                        $r->subject_type ? class_basename($r->subject_type) : ($r->properties['resource'] ?? null),
                        $r->subject_id ?? $r->properties['resource_id'] ?? null,
                        $r->description,
                        is_array($r->properties['changes'] ?? null) ? json_encode($r->properties['changes']) : ($r->properties['changes'] ?? null),
                        $r->properties['ip'] ?? null,
                        $r->properties['user_agent'] ?? null,
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

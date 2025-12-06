<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminAllowedIp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ActivityLogger;

class AdminIpController extends Controller
{
    public function index()
    {
        $ips = AdminAllowedIp::with('addedBy')->orderBy('created_at', 'desc')->get();
        return view('admin.settings.ip_whitelist', compact('ips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ip_address' => 'required|ip|unique:admin_allowed_ips,ip_address',
            'label' => 'nullable|string|max:255',
        ]);

        $adminId = Auth::user()->profile->id_administrateur;

        $created = AdminAllowedIp::create([
            'ip_address' => $request->ip_address,
            'label' => $request->label,
            'is_active' => true,
            'added_by' => $adminId,
        ]);

        // Audit the creation of a whitelist entry
        ActivityLogger::log(
            'admin',
            $adminId,
            'create',
            'admin_allowed_ip',
            $created->id,
            sprintf('Added allowed IP %s', $created->ip_address),
            [
                'ip_address' => $created->ip_address,
                'label' => $created->label,
                'is_active' => $created->is_active,
            ],
            $request
        );

        return redirect()->route('admin.settings.ip')->with('success', 'Adresse IP ajoutée avec succès.');
    }

    public function toggle(AdminAllowedIp $ip)
    {
        // Prevent deactivating your own IP
        if ($ip->ip_address === request()->ip() && $ip->is_active) {
             return redirect()->back()->with('error', __('app.impossible_desactiver_propre_ip'));
        }

        $old = $ip->is_active;
        $ip->update(['is_active' => ! $old]);

        ActivityLogger::log(
            'admin',
            Auth::user()->profile->id_administrateur,
            'update',
            'admin_allowed_ip',
            $ip->id,
            sprintf('Toggled IP %s active state from %s to %s', $ip->ip_address, $old ? 'active' : 'inactive', $ip->is_active ? 'active' : 'inactive'),
            ['is_active' => ['old' => $old, 'new' => $ip->is_active]],
            request()
        );
        return redirect()->back()->with('success', 'Statut de l\'IP mis à jour.');
    }

    public function destroy(AdminAllowedIp $ip)
    {
        // Prevent deleting your own IP
        if ($ip->ip_address === request()->ip()) {
             return redirect()->back()->with('error', __('app.impossible_supprimer_propre_ip'));
        }

        // Keep a snapshot for auditing before deleting
        $snapshot = $ip->toArray();
        $ip->delete();

        ActivityLogger::log(
            'admin',
            Auth::user()->profile->id_administrateur,
            'delete',
            'admin_allowed_ip',
            $snapshot['id'] ?? null,
            sprintf('Deleted allowed IP %s', $snapshot['ip_address'] ?? 'unknown'),
            $snapshot,
            request()
        );
        return redirect()->back()->with('success', 'Adresse IP supprimée.');
    }
}

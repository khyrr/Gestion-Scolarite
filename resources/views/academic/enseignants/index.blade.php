@extends('layouts.dashboard')

@section('title', __('app.enseignants'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.enseignants') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('enseignants.create') }}" class="btn btn-primary">
            {{ __('app.ajouter_enseignant') }}
        </a>
    @endadmin
@endsection

@section('content')
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stats-card">
            <div class="stats-icon" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                <i class="bi bi-person-badge"></i>
            </div>
            <div class="stats-content">
                <div class="stats-label">{{ __('app.total_enseignants') }}</div>
                <div class="stats-value">{{ $enseignant->count() }}</div>
            </div>
        </div>
        <div class="stats-card">
            <div class="stats-icon" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%);">
                <i class="bi bi-calendar-check"></i>
            </div>
            <div class="stats-content">
                <div class="stats-label">{{ __('app.actifs_ce_mois') }}</div>
                <div class="stats-value">{{ $enseignant->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
            </div>
        </div>
        <div class="stats-card">
            <div class="stats-icon" style="background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);">
                <i class="bi bi-book"></i>
            </div>
            <div class="stats-content">
                <div class="stats-label">{{ __('app.matieres_enseignees') }}</div>
                <div class="stats-value">{{ $enseignant->pluck('matiere')->unique()->count() }}</div>
            </div>
        </div>
        <div class="stats-card">
            <div class="stats-icon" style="background: linear-gradient(135deg, #ffc107 0%, #ff8c00 100%);">
                <i class="bi bi-people"></i>
            </div>
            <div class="stats-content">
                <div class="stats-label">{{ __('app.classes_assignees') }}</div>
                <div class="stats-value">{{ $enseignant->whereNotNull('id_classe')->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Enseignants Table -->
    <div class="table-card">
        <div class="table-header">
            <div>
                <h5 class="table-title">{{ __('app.liste_enseignants') }}</h5>
                <p class="table-subtitle">Gérez les enseignants et leurs affectations</p>
            </div>
        </div>

        @if($enseignant->count() > 0)
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>{{ __('app.nom_complet') }}</th>
                            <th>{{ __('app.email') }}</th>
                            <th>{{ __('app.telephone') }}</th>
                            <th>{{ __('app.matiere') }}</th>
                            <th>{{ __('app.classe') }}</th>
                            <th>{{ __('app.date_ajout') }}</th>
                            <th class="text-center">{{ __('app.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enseignant as $item)
                            <tr>
                                <td>
                                    <div class="teacher-name">
                                        <div class="teacher-avatar">
                                            {{ substr($item->prenom, 0, 1) }}{{ substr($item->nom, 0, 1) }}
                                        </div>
                                        <strong>{{ $item->prenom }} {{ $item->nom }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="mailto:{{ $item->email }}" class="email-link">
                                        <i class="bi bi-envelope"></i>
                                        {{ $item->email }}
                                    </a>
                                </td>
                                <td>
                                    <a href="tel:{{ $item->telephone }}" class="phone-link">
                                        <i class="bi bi-telephone"></i>
                                        {{ $item->telephone }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge-matiere">{{ $item->matiere }}</span>
                                </td>
                                <td>
                                    @if($item->classe)
                                        <span class="badge-classe">{{ $item->classe->nom_classe ?? 'N/A' }}</span>
                                    @else
                                        <span class="text-not-assigned">{{ __('app.non_assigne') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="date-badge">
                                        <i class="bi bi-calendar3"></i>
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @include('academic.enseignants.partials.actions', ['teacher' => $item])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-person-badge"></i>
                </div>
                <h4 class="empty-title">{{ __('app.no_data') }}</h4>
                <p class="empty-text">{{ __('app.aucun_enseignant_ajoute') }}</p>
                @admin
                    <a href="{{ route('enseignants.create') }}" class="btn-empty-action">
                        <i class="bi bi-plus-circle"></i>
                        {{ __('app.ajouter_premier_enseignant') }}
                    </a>
                @endadmin
            </div>
        @endif
    </div>
@endsection

@push('styles')
<style>
    :root {
        --primary-color: #0d6efd;
        --primary-dark: #0a58ca;
        --success-color: #198754;
        --info-color: #0dcaf0;
        --warning-color: #ffc107;
        --bg-white: #ffffff;
        --bg-light: #f8f9fa;
        --bg-gray-50: #fafafa;
        --text-dark: #212529;
        --text-muted: #6c757d;
        --text-light: #868e96;
        --border-color: #dee2e6;
        --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);
        --shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 4px 16px rgba(0, 0, 0, 0.12);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .stats-card {
        background: var(--bg-white);
        border-radius: 12px;
        padding: 24px;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    [dir="rtl"] .stats-card {
        flex-direction: row-reverse;
    }

    .stats-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-3px);
    }

    .stats-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stats-icon i {
        font-size: 28px;
        color: var(--bg-white);
    }

    .stats-content {
        flex: 1;
    }

    .stats-label {
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 6px;
        font-weight: 500;
    }

    .stats-value {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1;
    }

    /* Table Card */
    .table-card {
        background: var(--bg-white);
        border-radius: 12px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .table-header {
        padding: 24px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    }

    [dir="rtl"] .table-header {
        flex-direction: row-reverse;
    }

    .table-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0 0 4px 0;
    }

    .table-subtitle {
        font-size: 14px;
        color: var(--text-muted);
        margin: 0;
    }

    /* Modern Table */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .modern-table thead th {
        background: var(--bg-gray-50);
        padding: 16px 20px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--border-color);
        white-space: nowrap;
    }

    [dir="rtl"] .modern-table thead th {
        text-align: right;
    }

    .modern-table tbody tr {
        transition: all 0.2s ease;
    }

    .modern-table tbody tr:hover {
        background: var(--bg-light);
    }

    .modern-table tbody td {
        padding: 16px 20px;
        border-bottom: 1px solid var(--border-color);
        font-size: 14px;
        color: var(--text-dark);
        vertical-align: middle;
    }

    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Teacher Name with Avatar */
    .teacher-name {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    [dir="rtl"] .teacher-name {
        flex-direction: row-reverse;
    }

    .teacher-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--bg-white);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        flex-shrink: 0;
    }

    /* Email and Phone Links */
    .email-link,
    .phone-link {
        color: var(--text-dark);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: color 0.2s ease;
    }

    [dir="rtl"] .email-link,
    [dir="rtl"] .phone-link {
        flex-direction: row-reverse;
    }

    .email-link:hover {
        color: var(--primary-color);
    }

    .phone-link:hover {
        color: var(--success-color);
    }

    .email-link i,
    .phone-link i {
        font-size: 14px;
        opacity: 0.7;
    }

    /* Badges */
    .badge-matiere {
        display: inline-block;
        padding: 6px 12px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--bg-white);
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
    }

    .badge-classe {
        display: inline-block;
        padding: 6px 12px;
        background: var(--bg-light);
        color: var(--text-dark);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
    }

    .text-not-assigned {
        color: var(--text-muted);
        font-style: italic;
        font-size: 13px;
    }

    .date-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--text-muted);
        font-size: 13px;
    }

    [dir="rtl"] .date-badge {
        flex-direction: row-reverse;
    }

    .date-badge i {
        font-size: 14px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, var(--bg-light) 0%, var(--bg-gray-50) 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-icon i {
        font-size: 40px;
        color: var(--text-light);
    }

    .empty-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0 0 8px 0;
    }

    .empty-text {
        font-size: 14px;
        color: var(--text-muted);
        margin: 0 0 24px 0;
    }

    .btn-empty-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--bg-white);
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    [dir="rtl"] .btn-empty-action {
        flex-direction: row-reverse;
    }

    .btn-empty-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        color: var(--bg-white);
    }

    /* Responsive Design */
    /* Extra Large Devices (≤1400px) */
    @media (max-width: 1400px) {
        .stats-grid {
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }
    }

    /* Large Devices (≤1200px) */
    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        
        .stats-card {
            padding: 20px;
        }
        
        .table-card {
            border-radius: 10px;
        }
    }

    /* Medium Devices (≤992px) */
    @media (max-width: 992px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        
        .stats-card {
            padding: 18px;
        }
        
        .stats-icon {
            width: 52px;
            height: 52px;
        }
        
        .stats-icon i {
            font-size: 26px;
        }
        
        .stats-value {
            font-size: 26px;
        }
        
        .stats-label {
            font-size: 12px;
        }
        
        .table-header {
            padding: 20px;
        }
        
        .table-title {
            font-size: 17px;
        }
        
        .table-subtitle {
            font-size: 13px;
        }
        
        .modern-table thead th,
        .modern-table tbody td {
            padding: 14px 16px;
            font-size: 13px;
        }
    }

    /* Small Devices (≤768px) */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .stats-card {
            padding: 16px;
            gap: 12px;
        }

        .stats-icon {
            width: 48px;
            height: 48px;
        }

        .stats-icon i {
            font-size: 22px;
        }

        .stats-value {
            font-size: 22px;
        }
        
        .stats-label {
            font-size: 11px;
        }

        .table-header {
            padding: 16px 20px;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .table-title {
            font-size: 16px;
        }
        
        .table-subtitle {
            font-size: 12px;
        }

        .modern-table {
            font-size: 12px;
        }

        .modern-table thead th {
            padding: 12px 14px;
            font-size: 11px;
        }
        
        .modern-table tbody td {
            padding: 12px 14px;
        }

        .teacher-name {
            gap: 10px;
        }

        .teacher-avatar {
            width: 36px;
            height: 36px;
            font-size: 12px;
        }

        .badge-matiere,
        .badge-classe {
            font-size: 11px;
            padding: 5px 10px;
        }
        
        .date-badge {
            font-size: 12px;
        }
        
        .email-link,
        .phone-link {
            font-size: 12px;
        }
        
        .email-link i,
        .phone-link i {
            font-size: 12px;
        }
    }

    /* Extra Small Devices (≤576px) */
    @media (max-width: 576px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .stats-card {
            padding: 16px;
        }
        
        .stats-icon {
            width: 44px;
            height: 44px;
        }
        
        .stats-icon i {
            font-size: 20px;
        }
        
        .stats-value {
            font-size: 24px;
        }
        
        .stats-label {
            font-size: 12px;
        }
        
        .table-card {
            border-radius: 8px;
        }
        
        .table-header {
            padding: 16px;
        }
        
        .table-title {
            font-size: 15px;
        }
        
        .table-subtitle {
            font-size: 12px;
        }
        
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .modern-table {
            min-width: 800px;
            font-size: 12px;
        }
        
        .modern-table thead th {
            padding: 10px 12px;
            font-size: 10px;
            white-space: nowrap;
        }
        
        .modern-table tbody td {
            padding: 10px 12px;
        }
        
        .teacher-avatar {
            width: 32px;
            height: 32px;
            font-size: 11px;
        }
        
        .badge-matiere,
        .badge-classe {
            font-size: 10px;
            padding: 4px 8px;
        }
        
        .date-badge {
            font-size: 11px;
        }

        .empty-state {
            padding: 50px 20px;
        }

        .empty-icon {
            width: 60px;
            height: 60px;
            margin-bottom: 20px;
        }

        .empty-icon i {
            font-size: 28px;
        }
        
        .empty-title {
            font-size: 18px;
        }
        
        .empty-text {
            font-size: 13px;
            margin-bottom: 20px;
        }
        
        .btn-empty-action {
            padding: 10px 20px;
            font-size: 13px;
        }
    }

    /* Very Small Devices (≤400px) */
    @media (max-width: 400px) {
        .stats-card {
            padding: 14px;
            gap: 10px;
        }
        
        .stats-icon {
            width: 40px;
            height: 40px;
        }
        
        .stats-icon i {
            font-size: 18px;
        }
        
        .stats-value {
            font-size: 20px;
        }
        
        .stats-label {
            font-size: 11px;
        }
        
        .table-header {
            padding: 14px;
        }
        
        .table-title {
            font-size: 14px;
        }
        
        .table-subtitle {
            font-size: 11px;
        }
        
        .modern-table {
            min-width: 750px;
        }
        
        .teacher-avatar {
            width: 30px;
            height: 30px;
            font-size: 10px;
        }
        
        .empty-icon {
            width: 50px;
            height: 50px;
        }
        
        .empty-icon i {
            font-size: 24px;
        }
        
        .empty-title {
            font-size: 16px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Voulez-vous vraiment supprimer cet enregistrement ?",
            text: "Si vous le supprimez, il disparaîtra pour toujours.",
            icon: "warning",
            type: "warning",
            buttons: ["Annuler", "Oui!"],
            confirmButtonColor: '#d33',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
@endpush

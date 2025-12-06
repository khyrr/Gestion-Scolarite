@props([
    'activities',
    'limit' => 6,          // number of items to show if you want to limit
    'compact' => false,    // true => smaller row heights, smaller text
    'showAvatar' => true,  // toggle avatar column
])

@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;

    // Icon + color mapping
    $map = [
        'created'  => ['icon' => 'fa-plus',         'color' => 'success', 'bg' => 'success-subtle'],
        'ajout'    => ['icon' => 'fa-plus',         'color' => 'success', 'bg' => 'success-subtle'],
        'créé'     => ['icon' => 'fa-plus',         'color' => 'success', 'bg' => 'success-subtle'],
        'updated'  => ['icon' => 'fa-pen',          'color' => 'primary', 'bg' => 'primary-subtle'],
        'modifié'  => ['icon' => 'fa-pen',          'color' => 'primary', 'bg' => 'primary-subtle'],
        'mis à jour'=> ['icon' => 'fa-pen',         'color' => 'primary', 'bg' => 'primary-subtle'],
        'deleted'  => ['icon' => 'fa-trash',        'color' => 'danger',  'bg' => 'danger-subtle'],
        'supprimé' => ['icon' => 'fa-trash',        'color' => 'danger',  'bg' => 'danger-subtle'],
        'login'    => ['icon' => 'fa-sign-in-alt',  'color' => 'info',    'bg' => 'info-subtle'],
        'connexion'=> ['icon' => 'fa-sign-in-alt',  'color' => 'info',    'bg' => 'info-subtle'],
    ];

    // Helper to choose mapping based on description
    $resolveMeta = function($desc) use ($map) {
        $desc = Str::lower($desc ?: '');
        foreach ($map as $k => $meta) {
            if (Str::contains($desc, $k)) return $meta;
        }
        return ['icon' => 'fa-circle', 'color' => 'secondary', 'bg' => 'light'];
    };

    // Group by date label: Today / Yesterday / Earlier
    $grouped = $activities
        ->when($limit, fn($q) => $q->take($limit))
        ->groupBy(function($item) {
            $d = $item->created_at instanceof \Carbon\Carbon ? $item->created_at : Carbon::parse($item->created_at);
            if ($d->isToday()) return 'today';
            if ($d->isYesterday()) return 'yesterday';
            return 'earlier';
        });

    $dateLabels = [
        'today' => __('app.aujourdhui') ?? 'Today',
        'yesterday' => __('app.hier') ?? 'Yesterday',
        'earlier' => __('app.plus_tard') ?? 'Earlier',
    ];
@endphp

<div class="card h-100 shadow-sm border-0" role="region" aria-labelledby="recent-activity-title" aria-live="polite">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 id="recent-activity-title" class="card-title mb-0 fw-bold text-dark">
            <i class="fas fa-history me-2 text-primary" aria-hidden="true"></i>
            {{ __('app.activites_recentes') }}
        </h5>

        <div class="d-flex gap-2 align-items-center">
            <a href="{{ route('admin.logs.index') }}" class="btn btn-sm btn-light text-muted rounded-pill px-3">
                {{ __('app.voir_tout') }} <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        @if($activities->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="fas fa-inbox fa-3x mb-3 opacity-25" aria-hidden="true"></i>
                <p class="mb-3">{{ __('app.aucune_activite') }}</p>
                <a href="{{ route('admin.logs.index') }}" class="btn btn-sm btn-outline-primary">
                    {{ __('app.voir_tout') }}
                </a>
            </div>
        @else
            <div class="list-group list-group-flush">
                @foreach($grouped as $period => $items)
                    <div class="px-3 py-2 text-uppercase small text-muted bg-light border-bottom border-top sticky-top" style="z-index: 10;">
                        {{ $dateLabels[$period] ?? ucfirst($period) }}
                    </div>

                    @foreach($items as $activity)
                        @php
                            $meta = $resolveMeta($activity->description);
                            $causerName = $activity->causer?->name ?? __('app.system') ?? 'System';
                            $subjectLabel = $activity->subject_type ? class_basename($activity->subject_type) . (@$activity->subject_id ? " #{$activity->subject_id}" : '') : null;
                            $dt = $activity->created_at instanceof \Carbon\Carbon ? $activity->created_at : Carbon::parse($activity->created_at);
                            $timeTitle = $dt->toDayDateTimeString();
                            
                            // Check if this is the last item in the current group
                            $isLastInGroup = $loop->last;
                            // Check if this is the very last item overall (to hide the tail)
                            $isLastOverall = $loop->parent->last && $loop->last;
                        @endphp

                        <div
                            class="list-group-item d-flex gap-3 align-items-start py-3 px-3 hover-bg-light transition-all position-relative overflow-hidden border-0 @if($compact) py-2 @endif"
                            tabindex="0"
                            aria-label="{{ $activity->description }} — {{ $causerName }} — {{ $dt->diffForHumans() }}">
                            
                            @if($showAvatar)
                                <div class="flex-shrink-0 position-relative" style="z-index: 1;">
                                    <!-- Timeline Line -->
                                    @if(!$isLastOverall)
                                        <div class="timeline-line"></div>
                                    @endif
                                    
                                    <div class="avatar-sm rounded-circle bg-{{ $meta['bg'] }} d-flex align-items-center justify-content-center text-{{ $meta['color'] }} shadow-sm position-relative" style="width:40px;height:40px; z-index: 2;">
                                        @if($activity->causer && $activity->causer->avatar)
                                            <img alt="{{ $causerName }}" src="{{ $activity->causer->avatar }}" class="rounded-circle" loading="lazy" style="width:100%;height:100%;object-fit:cover;">
                                        @else
                                            <span class="fw-semibold small text-{{ $meta['color'] }}">
                                                {{ strtoupper(substr($causerName,0,1)) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="flex-grow-1 pt-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="me-2">
                                        <h6 class="mb-1 fw-bold text-dark small @if($compact) fs-6 @endif">
                                            {{ $activity->description }}
                                        </h6>

                                        <div class="text-muted small mb-0">
                                            <span class="fw-medium text-dark">{{ $causerName }}</span>

                                            @if($subjectLabel)
                                                <span class="mx-1">&bull;</span>
                                                <span class="text-secondary bg-light px-1 rounded">{{ $subjectLabel }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="text-end ms-2 whitespace-nowrap">
                                        <time datetime="{{ $dt->toIso8601String() }}" title="{{ $timeTitle }}" class="small text-muted fw-medium" style="font-size: 0.75rem;">
                                            {{ $dt->diffForHumans() }}
                                        </time>
                                    </div>
                                </div>

                                @if(!empty($activity->properties['message'] ?? '') || !empty($activity->properties['excerpt'] ?? ''))
                                    <div class="mt-2 p-2 bg-light rounded border-start border-3 border-{{ $meta['color'] }} small text-muted">
                                        {{ Str::limit($activity->properties['message'] ?? $activity->properties['excerpt'] ?? '', 120) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endforeach

                @if($activities->count() > $limit)
                    <div class="list-group-item text-center border-top py-2 bg-light">
                        <a href="{{ route('admin.logs.index') }}" class="small text-decoration-none fw-bold text-primary">
                            {{ __('app.charger_plus') ?? 'Load more' }} <i class="fas fa-chevron-down ms-1"></i>
                        </a>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

<style>
    .hover-bg-light:hover,
    .list-group-item:focus {
        background-color: #f8f9fa;
        outline: none;
    }

    .transition-all {
        transition: background-color .18s ease, transform .12s ease;
    }

    .list-group-item:active {
        transform: translateY(1px);
    }

    .avatar-sm { width: 2.5rem; height: 2.5rem; }

    /* Timeline Line */
    .timeline-line {
        position: absolute;
        top: 40px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: calc(100% + 2rem); /* Extend to next item */
        background-color: #e9ecef;
        z-index: 0;
    }

    /* Subtle colored backgrounds */
    .bg-success-subtle { background-color: #d1e7dd !important; }
    .bg-primary-subtle { background-color: #cfe2ff !important; }
    .bg-danger-subtle  { background-color: #f8d7da !important; }
    .bg-info-subtle    { background-color: #cff4fc !important; }

    /* Compact adjustments */
    @if($compact)
    .list-group-item { padding-top: .4rem !important; padding-bottom: .4rem !important; }
    .list-group-item h6 { font-size: .9rem !important; }
    @endif
</style>

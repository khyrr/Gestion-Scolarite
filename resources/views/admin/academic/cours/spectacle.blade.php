@extends('admin.layouts.dashboard')

@section('title', __('app.emploi_du_temps'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.cours.index') }}">{{ __('app.cours') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.emploi_du_temps') }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.cours.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            {{ __('app.retour') }}
        </a>
        @admin
            <a href="{{ route('admin.cours.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>
                {{ __('app.ajouter_cours') }}
            </a>
        @endadmin
    </div>
@endsection

@section('content')
<div class="google-container">
    <!-- Header Section -->
    <div class="google-page-header">
        <div>
            <h1 class="google-page-title">{{ __('app.emploi_du_temps') }}</h1>
            <p class="google-page-subtitle">{{ __('app.consulter_emploi_temps') }}</p>
        </div>
        <div class="google-header-controls">
            <select id="classeSelect" class="google-select">
                @foreach ($classes as $classe)
                    <option value="{{ $classe->id_classe }}" {{ request('classe') == $classe->id_classe ? 'selected' : '' }}>
                        {{ $classe->nom_classe }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Timetable -->
    <div class="google-timetable-wrapper">
        <div id="timetableContainer">
            <table class="google-timetable">
                    <thead>
                        <tr>
                            <th class="google-time-column">{{ __('app.horaire') }}</th>
                            <th class="google-day-column">{{ __('app.lundi') }}</th>
                            <th class="google-day-column">{{ __('app.mardi') }}</th>
                            <th class="google-day-column">{{ __('app.mercredi') }}</th>
                            <th class="google-day-column">{{ __('app.jeudi') }}</th>
                            <th class="google-day-column">{{ __('app.vendredi') }}</th>
                        </tr>
                    </thead>
                    <tbody id="scheduleTableBody">
                    </tbody>
                </table>
            </div>

        <!-- Empty State -->
        <div id="emptyState" class="google-empty-state" style="display: none;">
            <i class="bi bi-calendar-x google-empty-icon" aria-hidden="true"></i>
            <h5 class="google-empty-title">{{ __('app.aucun_cours_trouve') }}</h5>
            <p class="google-empty-text">{{ __('app.aucun_cours_pour_cette_classe') }}</p>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Page-Specific - Timetable specific styles */
.course-cell {
    display: block;
    padding: var(--google-spacing-md);
    background: var(--google-blue-light);
    border: 1px solid var(--google-blue);
    color: var(--google-gray-900);
    text-decoration: none;
    border-radius: 4px;
    transition: var(--google-transition);
}

.course-cell:hover {
    background: var(--google-blue);
    color: white;
    box-shadow: var(--google-shadow-1);
    text-decoration: none;
}

.course-matiere {
    font-weight: 500;
    font-size: 0.875rem;
    margin-bottom: var(--google-spacing-xs);
    color: inherit;
}

.course-enseignant {
    font-size: 0.75rem;
    color: inherit;
    opacity: 0.8;
}

.empty-cell {
    color: var(--google-gray-300);
    font-size: 1.5rem;
}

.empty-cell-clickable {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: var(--google-spacing-md);
    color: var(--google-gray-500);
    text-decoration: none;
    border: 2px dashed var(--google-gray-300);
    border-radius: 4px;
    transition: var(--google-transition);
    min-height: 80px;
}

.empty-cell-clickable:hover {
    color: var(--google-blue);
    border-color: var(--google-blue);
    background: var(--google-blue-light);
    text-decoration: none;
}

.empty-cell-clickable i {
    font-size: 1.5rem;
    margin-bottom: var(--google-spacing-xs);
}

.empty-cell-clickable small {
    font-size: 0.75rem;
    font-weight: 500;
}

@media (max-width: 768px) {
    .course-cell {
        padding: var(--google-spacing-sm);
    }
    
    .course-matiere {
        font-size: 0.75rem;
    }
    
    .course-enseignant {
        font-size: 0.7rem;
    }

    .empty-cell-clickable {
        min-height: 60px;
        padding: var(--google-spacing-sm);
    }
}
</style>
@endpush

@push('scripts')
<script>
    const scheduleData = @json($schedule);
    const timeSlots = @json($timeSlots);
    const jours = @json($jours);
    const isAdmin = @json(auth()->user()->role === 'admin');

    function renderSchedule(classeId) {
        const tbody = document.getElementById('scheduleTableBody');
        const emptyState = document.getElementById('emptyState');
        const table = document.getElementById('timetableContainer');

        tbody.innerHTML = '';

        if (!scheduleData[classeId] || Object.keys(scheduleData[classeId]).length === 0) {
            table.style.display = 'none';
            emptyState.style.display = 'block';
            return;
        }

        table.style.display = 'block';
        emptyState.style.display = 'none';

        timeSlots.forEach(slot => {
            const timeSlotKey = slot.debut + '-' + slot.fin;
            const courses = scheduleData[classeId][timeSlotKey] || {};
            
            const row = document.createElement('tr');

            const timeCell = document.createElement('td');
            timeCell.innerHTML = '<strong>' + slot.debut + '</strong><br><small class="text-muted">-</small><br><strong>' + slot.fin + '</strong>';
            row.appendChild(timeCell);

            jours.forEach(jour => {
                const cell = document.createElement('td');

                const course = courses[jour];

                if (course) {
                    const link = document.createElement('a');
                    link.href = '/cours/' + course.id_cours + '/edit?from_timetable=1&id_classe=' + classeId + 
                                '&date_debut=' + encodeURIComponent(slot.debut) + 
                                '&date_fin=' + encodeURIComponent(slot.fin) + 
                                '&jour=' + jour;
                    link.className = 'course-cell';

                    const matiereDiv = document.createElement('div');
                    matiereDiv.className = 'course-matiere';
                    matiereDiv.textContent = course.matiere ? course.matiere.code_matiere : 'N/A';

                    const enseignantDiv = document.createElement('div');
                    enseignantDiv.className = 'course-enseignant';
                    enseignantDiv.textContent = course.enseignant 
                        ? course.enseignant.prenom + ' ' + course.enseignant.nom
                        : '{{ __("app.non_assigne") }}';

                    link.appendChild(matiereDiv);
                    link.appendChild(enseignantDiv);
                    cell.appendChild(link);
                } else {
                    // Empty cell
                    if (isAdmin) {
                        const addLink = document.createElement('a');
                        addLink.href = '#';
                        addLink.className = 'empty-cell-clickable';
                        addLink.innerHTML = '<i class="bi bi-plus-circle"></i><br><small>Ajouter</small>';
                        addLink.onclick = function(e) {
                            e.preventDefault();
                            addCourse(classeId, slot.debut, slot.fin, jour);
                        };
                        cell.appendChild(addLink);
                    } else {
                        const emptySpan = document.createElement('span');
                        emptySpan.className = 'empty-cell';
                        emptySpan.textContent = '—';
                        cell.appendChild(emptySpan);
                    }
                }

                row.appendChild(cell);
            });

            tbody.appendChild(row);
        });
    }

    function addCourse(classeId, dateDebut, dateFin, jour) {
        // Build URL with pre-filled data
        const url = new URL('{{ route("cours.create") }}', window.location.origin);
        url.searchParams.append('from_timetable', '1');
        url.searchParams.append('id_classe', classeId);
        url.searchParams.append('date_debut', dateDebut + ':00');
        url.searchParams.append('date_fin', dateFin + ':00');
        url.searchParams.append('jour', jour);
        
        window.location.href = url.toString();
    }

    const classeSelect = document.getElementById('classeSelect');
    classeSelect.addEventListener('change', function() {
        renderSchedule(this.value);
    });

    if (classeSelect.value) {
        renderSchedule(classeSelect.value);
    }
</script>
@endpush

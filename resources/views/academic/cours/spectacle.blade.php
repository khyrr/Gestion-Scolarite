@extends('layouts.dashboard')

@section('title', __('app.emploi_du_temps'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('cours.index') }}">{{ __('app.cours') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.emploi_du_temps') }}</li>
@endsection

@section('header-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('cours.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            {{ __('app.retour') }}
        </a>
        @admin
            <a href="{{ route('cours.create') }}" class="btn btn-primary">
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
            <svg class="google-empty-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <line x1="7" y1="14" x2="17" y2="14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <line x1="12" y1="14" x2="12" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <h5 class="google-empty-title">{{ __('app.aucun_cours_trouve') }}</h5>
            <p class="google-empty-text">{{ __('app.aucun_cours_pour_cette_classe') }}</p>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
:root {
    --google-blue: #1a73e8;
    --google-blue-hover: #1967d2;
    --google-blue-light: #e8f0fe;
    --google-gray-50: #f8f9fa;
    --google-gray-100: #f1f3f4;
    --google-gray-200: #e8eaed;
    --google-gray-300: #dadce0;
    --google-gray-400: #bdc1c6;
    --google-gray-500: #9aa0a6;
    --google-gray-600: #80868b;
    --google-gray-700: #5f6368;
    --google-gray-800: #3c4043;
    --google-gray-900: #202124;
    --google-spacing-xs: 4px;
    --google-spacing-sm: 8px;
    --google-spacing-md: 16px;
    --google-spacing-lg: 24px;
    --google-spacing-xl: 32px;
    --google-spacing-2xl: 48px;
    --google-shadow-1: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
    --google-shadow-2: 0 1px 3px 0 rgba(60, 64, 67, 0.3), 0 4px 8px 3px rgba(60, 64, 67, 0.15);
    --google-transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
}

/* Container */
.google-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: var(--google-spacing-lg);
}

/* Page Header */
.google-page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: var(--google-spacing-xl);
}

.google-page-title {
    font-size: 2rem;
    font-weight: 400;
    color: var(--google-gray-900);
    margin: 0 0 var(--google-spacing-xs) 0;
}

.google-page-subtitle {
    font-size: 0.875rem;
    color: var(--google-gray-600);
    margin: 0;
}

.google-header-controls {
    min-width: 250px;
}

.google-select {
    width: 100%;
    padding: 8px 12px;
    font-size: 0.875rem;
    color: var(--google-gray-900);
    border: 1px solid var(--google-gray-300);
    border-radius: 4px;
    background: white;
    transition: var(--google-transition);
}

.google-select:focus {
    outline: none;
    border-color: var(--google-blue);
    box-shadow: 0 0 0 1px var(--google-blue);
}

/* Timetable Wrapper */
.google-timetable-wrapper {
    background: white;
    border: 1px solid var(--google-gray-300);
    border-radius: 8px;
    overflow: hidden;
}

/* Timetable */
.google-timetable {
    width: 100%;
    border-collapse: collapse;
}

.google-timetable thead {
    background: var(--google-gray-50);
    border-bottom: 1px solid var(--google-gray-300);
}

.google-timetable thead th {
    padding: var(--google-spacing-md);
    text-align: center;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--google-gray-900);
}

.google-time-column {
    width: 120px;
    background: var(--google-gray-100);
}

.google-day-column {
    min-width: 150px;
}

.google-timetable tbody td {
    padding: var(--google-spacing-md);
    vertical-align: top;
    border: 1px solid var(--google-gray-200);
    text-align: center;
}

.google-timetable tbody td:first-child {
    background: var(--google-gray-50);
    font-weight: 500;
    color: var(--google-gray-700);
    font-size: 0.875rem;
}

/* Course Cell */
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

/* Empty Cell Clickable (for admins) */
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

/* Empty State */
.google-empty-state {
    text-align: center;
    padding: var(--google-spacing-2xl);
}

.google-empty-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto var(--google-spacing-md);
    color: var(--google-gray-400);
}

.google-empty-title {
    font-size: 1rem;
    font-weight: 400;
    color: var(--google-gray-700);
    margin: 0 0 var(--google-spacing-sm) 0;
}

.google-empty-text {
    font-size: 0.875rem;
    color: var(--google-gray-600);
    margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .google-page-header {
        flex-direction: column;
        gap: var(--google-spacing-md);
    }

    .google-header-controls {
        width: 100%;
        min-width: 0;
    }

    .google-timetable thead th {
        padding: var(--google-spacing-sm);
        font-size: 0.75rem;
    }
    
    .google-timetable tbody td {
        padding: var(--google-spacing-sm);
    }
    
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

@media (max-width: 480px) {
    .google-container {
        padding: var(--google-spacing-md);
    }

    .google-page-title {
        font-size: 1.5rem;
    }

    .google-day-column {
        min-width: 100px;
    }

    .google-time-column {
        width: 80px;
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

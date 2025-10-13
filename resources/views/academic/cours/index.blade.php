@extends('layouts.dashboard')

@section('title', __('app.cours'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item active">{{ __('app.cours') }}</li>
@endsection

@section('header-actions')
    @admin
        <a href="{{ route('cours.create') }}" class="btn btn-primary">
            {{ __('app.ajouter_cours') }}
        </a>
    @endadmin
@endsection

@section('content')
<div class="container-fluid">
    <!-- Statistics Overview -->
    <div class="stats-grid">
        <div class="stats-card">
            <div class="icon-wrapper" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                <i class="fas fa-book-open"></i>
            </div>
            <div class="stats-content">
                <div class="stats-label">{{ __('app.total_cours') }}</div>
                <div class="stats-value">{{ $cours->count() }}</div>
            </div>
        </div>
        
        <div class="stats-card">
            <div class="icon-wrapper" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%);">
                <i class="fas fa-book"></i>
            </div>
            <div class="stats-content">
                <div class="stats-label">{{ __('app.matieres') }}</div>
                <div class="stats-value">{{ $cours->pluck('matiere')->unique()->count() }}</div>
            </div>
        </div>
        
        <div class="stats-card">
            <div class="icon-wrapper" style="background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div class="stats-content">
                <div class="stats-label">{{ __('app.aujourdhui') }}</div>
                <div class="stats-value">{{ $cours->where('jour', strtolower(now()->locale('fr_FR')->dayName))->count() }}</div>
            </div>
        </div>
        
        <div class="stats-card timetable-card">
            <div class="icon-wrapper">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="stats-content">
                <div class="stats-label">{{ __('app.emploi_du_temps') }}</div>
                <div class="stats-value">{{ __('app.voir_emploi_temps') }}</div>
            </div>
            <a href="{{ route('cours.spectacle') }}" class="timetable-link">
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Courses Table -->
    <div class="content-card">
        <div class="card-header-section">
            <div>
                <h5 class="card-title">{{ __('app.liste_cours') }}</h5>
                <p class="card-subtitle">{{ __('app.gestion_academique') }}</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters-grid">
            <div class="filter-group">
                <label class="filter-label">{{ __('app.rechercher') }}</label>
                <input type="text" class="form-control-md" id="searchInput" placeholder="{{ __('app.rechercher') }}...">
            </div>
            <div class="filter-group">
                <label class="filter-label">{{ __('app.jour') }}</label>
                <select class="form-control-md" id="dayFilter">
                    <option value="">{{ __('app.tous_les_jours') }}</option>
                    <option value="lundi">{{ __('app.lundi') }}</option>
                    <option value="mardi">{{ __('app.mardi') }}</option>
                    <option value="mercredi">{{ __('app.mercredi') }}</option>
                    <option value="jeudi">{{ __('app.jeudi') }}</option>
                    <option value="vendredi">{{ __('app.vendredi') }}</option>
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label">{{ __('app.classe') }}</label>
                <select class="form-control-md" id="classeFilter">
                    <option value="">{{ __('app.toutes_les_classes') }}</option>
                    @foreach($cours->pluck('classe')->unique()->filter() as $classe)
                        <option value="{{ $classe->nom_classe }}">{{ $classe->nom_classe }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label">{{ __('app.matiere') }}</label>
                <select class="form-control-md" id="matiereFilter">
                    <option value="">{{ __('app.toutes_les_matieres') }}</option>
                    @foreach($cours->pluck('matiere')->unique() as $matiere)
                        <option value="{{ $matiere->code_matiere }}">{{ $matiere->code_matiere }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label">{{ __('app.enseignant') }}</label>
                <select class="form-control-md" id="enseignantFilter">
                    <option value="">{{ __('app.tous_les_enseignants') }}</option>
                    @foreach($cours->pluck('enseignant')->unique()->filter() as $enseignant)
                        <option value="{{ $enseignant->prenom }} {{ $enseignant->nom }}">
                            {{ $enseignant->prenom }} {{ $enseignant->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        @if($cours->count() > 0)
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th>{{ __('app.matiere') }}</th>
                            <th>{{ __('app.classe') }}</th>
                            <th>{{ __('app.enseignant') }}</th>
                            <th class="text-center">{{ __('app.jour') }}</th>
                            <th class="text-center">{{ __('app.horaire') }}</th>
                            <th class="text-center" style="width: 120px;">{{ __('app.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody id="coursTableBody">
                        @foreach($cours as $course)
                        <tr>
                            <td><span class="id-badge">#{{ $course->id_cours }}</span></td>
                            <td>
                                <div class="matiere-cell">
                                    <span class="matiere-code">{{ $course->matiere->code_matiere }}</span>
                                    <span class="matiere-name">{{ $course->matiere->nom_matiere ?? $course->matiere->code_matiere }}</span>
                                </div>
                            </td>
                            <td>
                                @if($course->classe)
                                    <span class="level-badge">{{ $course->classe->nom_classe }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @if($course->enseignant)
                                    <span>{{ $course->enseignant->prenom }} {{ $course->enseignant->nom }}</span>
                                @else
                                    <span class="unassigned-text">{{ __('app.non_assigne') }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="day-badge">{{ ucfirst($course->jour) }}</span>
                            </td>
                            <td>
                                <div class="time-cell">
                                    <span class="time-start">{{ \Carbon\Carbon::parse($course->date_debut)->format('H:i') }}</span>
                                    <span class="time-separator">→</span>
                                    <span class="time-end">{{ \Carbon\Carbon::parse($course->date_fin)->format('H:i') }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                @include('academic.cours.partials.actions', ['course' => $course])
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- No Results Message -->
            <div id="noResultsMessage" class="empty-state" style="display: none;">
                <div class="empty-icon">
                    <i class="bi bi-search"></i>
                </div>
                <h5 class="empty-title">{{ __('app.aucun_resultat') }}</h5>
                <p class="empty-text">{{ __('app.essayez_autres_filtres') }}</p>
                <button class="btn-md btn-secondary" onclick="resetFilters()">
                    <i class="bi bi-arrow-clockwise"></i>
                    {{ __('app.reinitialiser_filtres') }}
                </button>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-calendar-x"></i>
                </div>
                <h5 class="empty-title">{{ __('app.aucun_cours_trouve') }}</h5>
                <p class="empty-text">{{ __('app.no_data') }}</p>
                @admin
                    <a href="{{ route('cours.create') }}" class="btn-md btn-primary">
                        <i class="bi bi-plus-circle"></i>
                        {{ __('app.ajouter_cours') }}
                    </a>
                @endadmin
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
:root {
    --md-primary: #0d6efd;
    --md-primary-dark: #0a58ca;
    --md-gray-50: #fafafa;
    --md-gray-100: #f5f5f5;
    --md-gray-200: #eeeeee;
    --md-gray-300: #e0e0e0;
    --md-gray-400: #bdbdbd;
    --md-gray-500: #9e9e9e;
    --md-gray-600: #757575;
    --md-gray-700: #616161;
    --md-gray-800: #424242;
    --md-gray-900: #212529;
    --md-radius: 12px;
    --md-shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
    --md-shadow: 0 2px 8px rgba(0,0,0,0.08);
    --md-shadow-lg: 0 8px 16px rgba(0,0,0,0.12);
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.stats-card {
    background: white;
    border-radius: var(--md-radius);
    padding: 24px;
    box-shadow: var(--md-shadow);
    display: flex;
    align-items: center;
    gap: 20px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.stats-card:hover {
    box-shadow: var(--md-shadow-lg);
    transform: translateY(-4px);
}

.stats-card .icon-wrapper {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    flex-shrink: 0;
}

.stats-content {
    flex: 1;
}

.stats-label {
    font-size: 13px;
    color: var(--md-gray-600);
    margin-bottom: 4px;
    font-weight: 500;
}

.stats-value {
    font-size: 28px;
    font-weight: 700;
    color: var(--md-gray-900);
}

.timetable-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.timetable-card .icon-wrapper {
    background: rgba(255,255,255,0.2);
}

.timetable-card .stats-label,
.timetable-card .stats-value {
    color: white;
}

.timetable-card .stats-value {
    font-size: 14px;
    font-weight: 600;
}

.timetable-link {
    width: 40px;
    height: 40px;
    background: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #667eea;
    text-decoration: none;
    transition: all 0.3s;
}

.timetable-link:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Content Card */
.content-card {
    background: white;
    border-radius: var(--md-radius);
    padding: 32px;
    box-shadow: var(--md-shadow);
}

.card-header-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
}

.card-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--md-gray-900);
    margin: 0;
}

.card-subtitle {
    font-size: 13px;
    color: var(--md-gray-600);
    margin: 4px 0 0 0;
}

/* Filters */
.filters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 28px;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--md-gray-700);
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-control-md {
    padding: 12px 16px;
    border: 1px solid var(--md-gray-300);
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s;
    background: white;
    color: var(--md-gray-900);
}

.form-control-md:focus {
    outline: none;
    border-color: var(--md-primary);
    box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
}

/* Modern Table */
.modern-table {
    width: 100%;
    border-collapse: collapse;
}

.modern-table thead th {
    padding: 14px 16px;
    text-align: left;
    font-size: 12px;
    font-weight: 600;
    color: var(--md-gray-700);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid var(--md-gray-200);
    background: var(--md-gray-50);
}

.modern-table tbody tr {
    border-bottom: 1px solid var(--md-gray-200);
    transition: background 0.2s;
}

.modern-table tbody tr:hover {
    background: var(--md-gray-50);
}

.modern-table tbody td {
    padding: 16px;
    font-size: 14px;
    color: var(--md-gray-800);
}

.id-badge {
    color: var(--md-gray-600);
    font-weight: 500;
    font-size: 13px;
}

.matiere-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}

.matiere-code {
    background: rgba(13, 110, 253, 0.1);
    color: var(--md-primary);
    padding: 4px 10px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 12px;
}

.matiere-name {
    color: var(--md-gray-800);
    font-weight: 500;
}

.level-badge {
    display: inline-flex;
    padding: 6px 12px;
    background: var(--md-gray-100);
    color: var(--md-gray-700);
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
}

.unassigned-text {
    color: var(--md-gray-500);
    font-style: italic;
    font-size: 13px;
}

.day-badge {
    display: inline-flex;
    padding: 6px 14px;
    background: rgba(108, 117, 125, 0.1);
    color: var(--md-gray-700);
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
}

.time-cell {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.time-start {
    color: #198754;
    font-weight: 600;
    font-size: 13px;
}

.time-separator {
    color: var(--md-gray-400);
    font-size: 12px;
}

.time-end {
    color: #dc3545;
    font-weight: 600;
    font-size: 13px;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 64px 24px;
}

.empty-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: var(--md-gray-100);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-icon i {
    font-size: 36px;
    color: var(--md-gray-400);
}

.empty-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--md-gray-700);
    margin-bottom: 8px;
}

.empty-text {
    font-size: 14px;
    color: var(--md-gray-600);
    margin-bottom: 24px;
}

/* Buttons */
.btn-md {
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-primary {
    background: var(--md-primary);
    color: white;
}

.btn-primary:hover {
    background: var(--md-primary-dark);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    transform: translateY(-2px);
    color: white;
}

.btn-secondary {
    background: var(--md-gray-200);
    color: var(--md-gray-700);
}

.btn-secondary:hover {
    background: var(--md-gray-300);
    color: var(--md-gray-800);
}

/* RTL Support */
[dir="rtl"] .stats-card {
    flex-direction: row-reverse;
}

[dir="rtl"] .matiere-cell {
    flex-direction: row-reverse;
}

[dir="rtl"] .time-separator {
    transform: scaleX(-1);
}

[dir="rtl"] .btn-md {
    flex-direction: row-reverse;
}

/* Responsive */
@media (max-width: 1199px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 767px) {
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .content-card {
        padding: 20px;
    }
    
    .filters-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .modern-table {
        font-size: 13px;
    }
    
    .modern-table tbody td {
        padding: 12px 8px;
    }
}

@media (max-width: 575px) {
    .stats-card {
        padding: 20px;
    }
    
    .stats-card .icon-wrapper {
        width: 48px;
        height: 48px;
        font-size: 20px;
    }
    
    .stats-value {
        font-size: 24px;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Filter functionality
const searchInput = document.getElementById('searchInput');
const dayFilter = document.getElementById('dayFilter');
const classeFilter = document.getElementById('classeFilter');
const matiereFilter = document.getElementById('matiereFilter');
const enseignantFilter = document.getElementById('enseignantFilter');
const noResultsMessage = document.getElementById('noResultsMessage');
const tableContainer = document.querySelector('.table-responsive');

function filterTable() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedDay = dayFilter.value.toLowerCase();
    const selectedClasse = classeFilter.value.toLowerCase();
    const selectedMatiere = matiereFilter.value.toLowerCase();
    const selectedEnseignant = enseignantFilter.value.toLowerCase();
    
    const rows = document.querySelectorAll('#coursTableBody tr');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const matiere = row.cells[1].textContent.toLowerCase();
        const classe = row.cells[2].textContent.toLowerCase();
        const enseignant = row.cells[3].textContent.toLowerCase();
        const jour = row.cells[4].textContent.toLowerCase();
        const rowText = row.textContent.toLowerCase();
        
        const matchesSearch = searchTerm === '' || rowText.includes(searchTerm);
        const matchesDay = selectedDay === '' || jour.includes(selectedDay);
        const matchesClasse = selectedClasse === '' || classe.includes(selectedClasse);
        const matchesMatiere = selectedMatiere === '' || matiere.includes(selectedMatiere);
        const matchesEnseignant = selectedEnseignant === '' || enseignant.includes(selectedEnseignant);
        
        if (matchesSearch && matchesDay && matchesClasse && matchesMatiere && matchesEnseignant) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Show/hide no results message
    if (visibleCount === 0) {
        tableContainer.style.display = 'none';
        noResultsMessage.style.display = 'block';
    } else {
        tableContainer.style.display = 'block';
        noResultsMessage.style.display = 'none';
    }
}

// Reset all filters
function resetFilters() {
    searchInput.value = '';
    dayFilter.value = '';
    classeFilter.value = '';
    matiereFilter.value = '';
    enseignantFilter.value = '';
    filterTable();
}

// Add event listeners
searchInput.addEventListener('keyup', filterTable);
dayFilter.addEventListener('change', filterTable);
classeFilter.addEventListener('change', filterTable);
matiereFilter.addEventListener('change', filterTable);
enseignantFilter.addEventListener('change', filterTable);
</script>
@endpush
@endsection

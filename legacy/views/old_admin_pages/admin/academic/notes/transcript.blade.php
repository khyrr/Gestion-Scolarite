@extends('admin.layouts.dashboard')

@section('title', __('app.releve_de_notes') . ' - ' . $etudiant->nom . ' ' . $etudiant->prenom)

@section('breadcrumbs')
    <x-breadcrumb>
        <x-breadcrumb-item href="{{ route('admin.dashboard') }}">{{ __('app.tableau_de_bord') }}</x-breadcrumb-item>
        <x-breadcrumb-item
            href="{{ route('admin.rapports.notes.transcript-index') }}">{{ __('app.relevés_de_notes') }}</x-breadcrumb-item>
        <x-breadcrumb-item active>{{ $etudiant->nom }} {{ $etudiant->prenom }}</x-breadcrumb-item>
    </x-breadcrumb>
@endsection

@section('content')
    <div class="transcript-container">
        <!-- Actions Bar (No Print) -->
        <div class="actions-bar no-print">
            <h1 class="page-title">{{ __('app.releve_de_notes') }}</h1>
            <div class="actions-group">
                <a href="{{ route('admin.rapports.notes.transcript-index') }}" class="action-btn secondary" aria-label="{{ __('app.retour') }}">
                    <i class="fas fa-arrow-left"></i>
                    {{ __('app.retour') }}
                </a>
                <button onclick="window.print()" class="action-btn primary" aria-label="{{ __('app.imprimer') }}">
                    <i class="fas fa-print"></i>
                    {{ __('app.imprimer') }}
                </button>
            </div>
        </div>

        <!-- Transcript Card -->
        <div class="transcript-card">
            <!-- Header -->
            <div class="transcript-header">
                <h2 class="transcript-title">{{ __('app.releve_de_notes') }}</h2>
                @if($trimestreInfo)
                    <p class="transcript-subtitle">{{ $trimestreInfo['name'] }} - {{ __('app.annee_scolaire') }}
                        {{ $academicYear }}</p>
                @else
                    <p class="transcript-subtitle">{{ __('app.annee_scolaire') }} {{ $academicYear }}</p>
                @endif
            </div>

            <!-- Year and Trimester Selector (No Print) -->
            <div class="selectors-row no-print">
                <div class="selector-field">
                    <label for="yearSelect" class="selector-label">{{ __('app.annee_scolaire') }}</label>
                    <select id="yearSelect" class="selector-input" onchange="changeYear()">
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}" {{ $year == $academicYear ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="selector-field">
                    <label for="trimestreSelect" class="selector-label">{{ __('app.trimestre') }}</label>
                    <select id="trimestreSelect" class="selector-input" onchange="changeTrimestre()">
                        <option value="" {{ !$trimestre ? 'selected' : '' }}>{{ __('app.tous_les_trimestres') }}</option>
                        <option value="1" {{ $trimestre == '1' ? 'selected' : '' }}>{{ __('app.premier_trimestre') }}</option>
                        <option value="2" {{ $trimestre == '2' ? 'selected' : '' }}>{{ __('app.deuxieme_trimestre') }}
                        </option>
                        <option value="3" {{ $trimestre == '3' ? 'selected' : '' }}>{{ __('app.troisieme_trimestre') }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Student Information -->
            <div class="student-section">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">{{ __('app.nom') }}</span>
                        <span class="info-value">{{ $etudiant->nom }} {{ $etudiant->prenom }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{{ __('app.matricule') }}</span>
                        <span class="info-value">{{ $etudiant->matricule }}</span>
                    </div>
                    @if($etudiant->classe)
                        <div class="info-item">
                            <span class="info-label">{{ __('app.classe') }}</span>
                            <span class="info-value">{{ $etudiant->classe->nom_classe }}</span>
                        </div>
                    @endif
                    <div class="info-item">
                        <span class="info-label">{{ __('app.date_de_naissance') }}</span>
                        <span
                            class="info-value">{{ $etudiant->date_naissance ? $etudiant->date_naissance->format('d/m/Y') : 'N/A' }}</span>
                    </div>
                </div>

                <div class="average-card">
                    <div class="average-value">{{ number_format($statistics['overall_average'], 2) }}<span
                            class="average-max">/20</span></div>
                    <div class="average-label">{{ __('app.moyenne_generale') }}</div>
                    <div class="average-mention">{{ $statistics['mention'] }}</div>
                </div>
            </div>

            <!-- Notes par matière -->
            @if($notesByMatiere->count() > 0)
                @foreach($notesByMatiere as $matiere => $matiereNotes)
                    <div class="subject-section">
                        <div class="subject-header">
                            <h3 class="subject-name">{{ $matiere }}</h3>
                            <span class="subject-average">
                                {{ __('app.moyenne') }}: {{ number_format($statistics['averages'][$matiere]['average'], 2) }}/20
                            </span>
                        </div>

                        <div class="notes-table-wrapper">
                            <table class="notes-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('app.date') }}</th>
                                        <th>{{ __('app.type') }}</th>
                                        <th>{{ __('app.note') }}</th>
                                        <th>{{ __('app.sur_20') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($matiereNotes as $note)
                                        <tr>
                                            <td>{{ $note->evaluation?->date?->format('d/m/Y') ?? 'N/A' }}</td>
                                            <td>{{ ucfirst($note->evaluation?->type ?? 'N/A') }}</td>
                                            <td>{{ $note->note }}/{{ $note->evaluation?->note_max ?? 20 }}</td>
                                            <td>
                                                @php
                                                    $noteMax = $note->evaluation?->note_max ?? 20;
                                                    $noteSur20 = ($note->note / $noteMax) * 20;
                                                @endphp
                                                <span class="note-value {{ $noteSur20 >= 10 ? 'pass' : 'fail' }}">
                                                    {{ number_format($noteSur20, 1) }}/20
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach

                <!-- Summary -->
                <div class="summary-section">
                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-value">{{ number_format($statistics['overall_average'], 2) }}/20</div>
                            <div class="summary-label">{{ __('app.moyenne_generale') }}</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value">{{ $statistics['passed_notes'] }}/{{ $statistics['total_notes'] }}</div>
                            <div class="summary-label">{{ __('app.notes_superieures') }}</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value">{{ $statistics['mention'] }}</div>
                            <div class="summary-label">{{ __('app.mention') }}</div>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-notes">
                    <i class="fas fa-inbox empty-icon" aria-hidden="true"></i>
                    <p class="empty-text">{{ __('app.aucune_note') }}</p>
                </div>
            @endif

            <!-- Footer -->
            <div class="transcript-footer">
                {{ __('app.document_genere_le') }} {{ now()->format('d/m/Y à H:i') }}
            </div>
        </div>
    </div>

    <style>
        /* Page-Specific Styles */
        .transcript-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: var(--spacing-xl) var(--spacing-md);
        }

        /* Actions Bar */
        .actions-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-xl);
        }

        .page-title {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 400;
            color: var(--text-primary);
            margin: 0;
        }

        .actions-group {
            display: flex;
            gap: var(--spacing-sm);
        }

        /* Transcript Card */
        .transcript-card {
            background: var(--bg-surface);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            padding: var(--spacing-xl);
        }

        .transcript-header {
            text-align: center;
            padding-bottom: var(--spacing-lg);
            border-bottom: 1px solid var(--border-color);
            margin-bottom: var(--spacing-lg);
        }

        .transcript-title {
            font-size: 1.75rem;
            font-weight: 400;
            color: var(--text-primary);
            margin: 0 0 var(--spacing-xs);
        }

        .transcript-subtitle {
            font-size: 1rem;
            color: var(--text-secondary);
            margin: 0;
        }

        /* Selectors */
        .selectors-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
        }

        .selector-field {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-xs);
        }

        .selector-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .selector-input {
            padding: 0.625rem 0.875rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            color: var(--text-primary);
            background: var(--bg-surface);
            transition: all 0.2s ease;
        }

        .selector-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.1);
        }

        /* Student Section */
        .student-section {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: var(--spacing-lg);
            padding: var(--spacing-lg);
            background: var(--bg-hover);
            border-radius: var(--radius-sm);
            margin-bottom: var(--spacing-xl);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-md);
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .info-label {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 0.9375rem;
            color: var(--text-primary);
        }

        .average-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: var(--spacing-lg);
            background: var(--bg-surface);
            border-radius: var(--radius-sm);
            min-width: 160px;
        }

        .average-value {
            font-size: 2.5rem;
            font-weight: 300;
            color: var(--primary-color);
            line-height: 1;
        }

        .average-max {
            font-size: 1.5rem;
            color: var(--text-secondary);
        }

        .average-label {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: var(--spacing-xs);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .average-mention {
            font-size: 0.875rem;
            color: var(--text-primary);
            margin-top: var(--spacing-xs);
            font-weight: 500;
        }

        /* Subject Section */
        .subject-section {
            margin-bottom: var(--spacing-xl);
        }

        .subject-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-md);
            padding-bottom: var(--spacing-sm);
            border-bottom: 2px solid var(--border-color);
        }

        .subject-name {
            font-size: 1.125rem;
            font-weight: 500;
            color: var(--text-primary);
            margin: 0;
        }

        .subject-average {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--primary-color);
            padding: 0.375rem 0.75rem;
            background: rgba(26, 115, 232, 0.1);
            border-radius: var(--radius-sm);
        }

        /* Notes Table */
        .notes-table-wrapper {
            overflow-x: auto;
        }

        .notes-table {
            width: 100%;
            border-collapse: collapse;
        }

        .notes-table th {
            text-align: left;
            padding: 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--border-color);
        }

        .notes-table td {
            padding: 0.875rem 0.75rem;
            font-size: 0.875rem;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
        }

        .notes-table tbody tr:hover {
            background: var(--bg-hover);
        }

        .note-value {
            font-weight: 500;
        }

        .note-value.pass {
            color: var(--success-color);
        }

        .note-value.fail {
            color: var(--error-color);
        }

        /* Summary Section */
        .summary-section {
            padding-top: var(--spacing-lg);
            border-top: 2px solid var(--border-color);
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: var(--spacing-md);
        }

        .summary-item {
            text-align: center;
            padding: var(--spacing-md);
            background: var(--bg-hover);
            border-radius: var(--radius-sm);
        }

        .summary-value {
            font-size: 1.5rem;
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: var(--spacing-xs);
        }

        .summary-label {
            font-size: 0.75rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Empty State */
        .empty-notes {
            text-align: center;
            padding: var(--spacing-xl);
        }

        /* Footer */
        .transcript-footer {
            text-align: center;
            padding-top: var(--spacing-lg);
            margin-top: var(--spacing-lg);
            border-top: 1px solid var(--border-color);
            font-size: 0.75rem;
            color: var(--text-tertiary);
        }

        /* Print Styles */
        @media print {
            .no-print {
                display: none !important;
            }

            .transcript-container {
                padding: 0;
            }

            .transcript-card {
                box-shadow: none;
                padding: 1rem;
            }

            body {
                font-size: 11px;
            }

            .notes-table {
                font-size: 10px;
            }

            .notes-table th,
            .notes-table td {
                padding: 0.375rem !important;
            }

            .subject-section {
                page-break-inside: avoid;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .transcript-container {
                padding: var(--spacing-md) var(--spacing-sm);
            }

            .actions-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: var(--spacing-md);
            }

            .student-section {
                grid-template-columns: 1fr;
            }

            .average-card {
                width: 100%;
            }

            .subject-header {
                flex-direction: column;
                align-items: flex-start;
                gap: var(--spacing-xs);
            }
        }
    </style>

    <script>
function changeYear() {
    const year = document.getElementById('yearSelect').value;
    const trimestre = document.getElementById('trimestreSelect').value;
    let url = `{{ route('admin.rapports.notes.transcript.full', $etudiant->matricule) }}`;
    
    if (trimestre) {
        url = `{{ url('rapports/notes/releves/' . $etudiant->matricule) }}/trimestre-${trimestre}`;
    }
    
    const params = new URLSearchParams();
    if (year) params.append('annee', year);
    
    if (params.toString()) {
        url += `?${params.toString()}`;
    }
    
    window.location.href = url;
}

function changeTrimestre() {
    const year = document.getElementById('yearSelect').value;
    const trimestre = document.getElementById('trimestreSelect').value;
    let url = `{{ route('admin.rapports.notes.transcript.full', $etudiant->matricule) }}`;
    
    if (trimestre) {
        url = `{{ url('rapports/notes/releves/' . $etudiant->matricule) }}/trimestre-${trimestre}`;
    }
    
    const params = new URLSearchParams();
    if (year) params.append('annee', year);
    
    if (params.toString()) {
        url += `?${params.toString()}`;
    }
    
    window.location.href = url;
}
    </script>
@endsection
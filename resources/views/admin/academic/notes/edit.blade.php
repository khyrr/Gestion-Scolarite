@extends('admin.layouts.dashboard')

@section('title', __('app.modifier_note'))

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('app.gestion_academique') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.notes.index') }}">{{ __('app.notes') }}</a></li>
    <li class="breadcrumb-item active">{{ __('app.modifier') }}</li>
@endsection

@section('content')
    <div class="note-edit-container">
        <div class="edit-card">
            <h1 class="edit-title">{{ __('app.modifier_note') }}</h1>

            <!-- Student Info Card -->
            <div class="info-card">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">{{ __('app.etudiant') }}</span>
                        <span class="info-value">{{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{{ __('app.classe') }}</span>
                        <span class="info-value">{{ $note->classe->nom_classe }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{{ __('app.evaluation') }}</span>
                        <span class="info-value">{{ $note->evaluation->titre ?? ucfirst($note->evaluation->type) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{{ __('app.note_max') }}</span>
                        <span class="info-value">{{ $note->evaluation->note_max }}</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.notes.update', $note) }}" method="POST" id="noteForm" class="edit-form">
                @csrf
                @method('PUT')

                <!-- Note Field -->
                <div class="form-group">
                    <label for="note" class="form-label">
                        {{ __('app.note') }} <span class="required">*</span>
                    </label>
                    <div class="input-group">
                        <input type="number" class="form-input @error('note') is-invalid @enderror" id="note" name="note"
                            value="{{ old('note', $note->note) }}" min="0" max="{{ $note->evaluation->note_max }}"
                            step="0.25" required>
                        <span class="input-suffix">/ {{ $note->evaluation->note_max }}</span>
                    </div>
                    @error('note')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                    <!-- Live Preview -->
                    <div class="preview-card" id="notePreview">
                        <div class="preview-item">
                            <span class="preview-label">Pourcentage</span>
                            <span class="preview-value" id="percentageDisplay">-</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Appréciation</span>
                            <span class="preview-badge" id="appreciationBadge">-</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Note Buttons -->
                <div class="form-group">
                    <label class="form-label-small">Saisie Rapide</label>
                    <div class="quick-buttons">
                        <button type="button" class="quick-btn" data-value="0">0</button>
                        <button type="button" class="quick-btn"
                            data-value="{{ $note->evaluation->note_max * 0.5 }}">{{ $note->evaluation->note_max * 0.5 }}</button>
                        <button type="button" class="quick-btn"
                            data-value="{{ $note->evaluation->note_max }}">{{ $note->evaluation->note_max }}</button>
                    </div>
                </div>

                <!-- Comment Field -->
                <div class="form-group">
                    <label for="commentaire" class="form-label">{{ __('app.commentaire') }}</label>
                    <textarea class="form-textarea @error('commentaire') is-invalid @enderror" id="commentaire"
                        name="commentaire" rows="4"
                        placeholder="Commentaire...">{{ old('commentaire', $note->commentaire) }}</textarea>
                    @error('commentaire')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="form-actions">
                    <a href="{{ url()->previous() }}" class="action-btn secondary">
                        {{ __('app.annuler') }}
                    </a>
                    <button type="submit" class="action-btn primary">
                        {{ __('app.enregistrer') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Google-Style Design System */
        :root {
            --primary-color: #1a73e8;
            --primary-hover: #1557b0;
            --success-color: #1e8e3e;
            --error-color: #d93025;
            --warning-color: #f9ab00;
            --text-primary: #202124;
            --text-secondary: #5f6368;
            --text-tertiary: #80868b;
            --border-color: #dadce0;
            --bg-surface: #ffffff;
            --bg-hover: #f8f9fa;
            --bg-info: #e8f0fe;
            --shadow-sm: 0 1px 2px 0 rgba(60, 64, 67, .3), 0 1px 3px 1px rgba(60, 64, 67, .15);
            --shadow-md: 0 1px 3px 0 rgba(60, 64, 67, .3), 0 4px 8px 3px rgba(60, 64, 67, .15);
            --radius-sm: 8px;
            --radius-md: 12px;
            --spacing-xs: 0.5rem;
            --spacing-sm: 0.75rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
        }

        .note-edit-container {
            max-width: 700px;
            margin: 0 auto;
            padding: var(--spacing-xl) var(--spacing-md);
        }

        /* Edit Card */
        .edit-card {
            background: var(--bg-surface);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            padding: var(--spacing-xl);
        }

        .edit-title {
            font-size: clamp(1.5rem, 3vw, 1.75rem);
            font-weight: 400;
            color: var(--text-primary);
            margin: 0 0 var(--spacing-lg);
        }

        /* Info Card */
        .info-card {
            background: var(--bg-info);
            border-radius: var(--radius-sm);
            padding: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: var(--spacing-md);
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .info-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 0.9375rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        /* Form */
        .edit-form {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-lg);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-xs);
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .form-label-small {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .required {
            color: var(--error-color);
        }

        .input-group {
            display: flex;
            align-items: stretch;
        }

        .form-input,
        .form-textarea {
            flex: 1;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            background: var(--bg-surface);
            color: var(--text-primary);
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.1);
        }

        .form-input.is-invalid,
        .form-textarea.is-invalid {
            border-color: var(--error-color);
        }

        .form-input.is-invalid:focus,
        .form-textarea.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(217, 48, 37, 0.1);
        }

        .input-suffix {
            display: flex;
            align-items: center;
            padding: 0 1rem;
            background: var(--bg-hover);
            border: 1px solid var(--border-color);
            border-left: none;
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .error-message {
            font-size: 0.75rem;
            color: var(--error-color);
            margin-top: 0.25rem;
        }

        /* Preview Card */
        .preview-card {
            display: flex;
            gap: var(--spacing-md);
            padding: var(--spacing-md);
            background: var(--bg-hover);
            border-radius: var(--radius-sm);
            margin-top: var(--spacing-sm);
        }

        .preview-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .preview-label {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .preview-value {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .preview-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: var(--bg-surface);
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        /* Quick Buttons */
        .quick-buttons {
            display: flex;
            gap: var(--spacing-xs);
        }

        .quick-btn {
            padding: 0.5rem 1rem;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .quick-btn:hover {
            background: var(--bg-hover);
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .quick-btn:active {
            transform: scale(0.98);
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            justify-content: space-between;
            gap: var(--spacing-md);
            padding-top: var(--spacing-md);
            border-top: 1px solid var(--border-color);
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .action-btn.primary {
            background: var(--primary-color);
            color: white;
        }

        .action-btn.primary:hover {
            background: var(--primary-hover);
            box-shadow: var(--shadow-sm);
        }

        .action-btn.secondary {
            background: var(--bg-surface);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .action-btn.secondary:hover {
            background: var(--bg-hover);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .note-edit-container {
                padding: var(--spacing-md) var(--spacing-sm);
            }

            .edit-card {
                padding: var(--spacing-lg);
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .quick-buttons {
                flex-wrap: wrap;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .action-btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .preview-card {
                flex-direction: column;
            }
        }
    </style>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const noteInput = document.getElementById('note');
                const noteMax = {{ $note->evaluation->note_max }};

                // Update preview when note changes
                function updatePreview() {
                    const noteValue = parseFloat(noteInput.value) || 0;
                    const percentage = (noteValue / noteMax) * 100;

                    // Update percentage
                    document.getElementById('percentageDisplay').textContent = Math.round(percentage) + '%';

                    // Update appreciation
                    let appreciation, badgeColor;
                    if (percentage >= 80) {
                        appreciation = 'Excellent';
                        badgeColor = '#1e8e3e';
                    } else if (percentage >= 60) {
                        appreciation = 'Bien';
                        badgeColor = '#1a73e8';
                    } else if (percentage >= 50) {
                        appreciation = 'Passable';
                        badgeColor = '#f9ab00';
                    } else {
                        appreciation = 'Insuffisant';
                        badgeColor = '#d93025';
                    }

                    const badge = document.getElementById('appreciationBadge');
                    badge.textContent = appreciation;
                    badge.style.color = badgeColor;
                    badge.style.borderLeft = `3px solid ${badgeColor}`;
                }

                // Event listeners
                noteInput.addEventListener('input', updatePreview);

                // Quick note buttons
                document.querySelectorAll('.quick-btn').forEach(button => {
                    button.addEventListener('click', function () {
                        noteInput.value = this.dataset.value;
                        updatePreview();
                        noteInput.focus();
                    });
                });

                // Initial preview
                updatePreview();

                // Form validation
                document.getElementById('noteForm').addEventListener('submit', function (e) {
                    const noteValue = parseFloat(noteInput.value);

                    if (noteValue < 0 || noteValue > noteMax) {
                        e.preventDefault();
                        alert(`La note doit être entre 0 et ${noteMax}`);
                        noteInput.focus();
                    }
                });

                // Focus note input on page load
                noteInput.focus();
                noteInput.select();
            });
        </script>
    @endpush
@endsection
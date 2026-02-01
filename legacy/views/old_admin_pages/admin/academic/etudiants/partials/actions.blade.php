<div class="google-action-buttons">
    <!-- View Button -->
    <a href="{{ route('admin.etudiants.show', $item) }}" 
       class="google-action-btn google-action-view" 
       title="{{ __('app.view') }}"
       aria-label="Voir l'étudiant {{ $item->prenom }} {{ $item->nom }}">
        <i class="fas fa-eye" aria-hidden="true"></i>
    </a>
    
    <!-- Edit Button -->
    @admin
        <a href="{{ route('admin.etudiants.edit', $item) }}" 
           class="google-action-btn google-action-edit" 
           title="{{ __('app.edit') }}"
           aria-label="Modifier l'étudiant {{ $item->prenom }} {{ $item->nom }}">
            <i class="fas fa-edit" aria-hidden="true"></i>
        </a>
    @endadmin
    
    <!-- Delete Button -->
    @admin
        <form action="{{ route('admin.etudiants.destroy', $item) }}" 
              method="POST" 
              class="d-inline">
            @csrf
            @method('DELETE')
            <button type="button" 
                    class="google-action-btn google-action-delete delete-student" 
                    title="{{ __('app.delete') }}"
                    aria-label="Supprimer l'étudiant {{ $item->prenom }} {{ $item->nom }}"
                    data-student-name="{{ $item->prenom }} {{ $item->nom }}">
                <i class="fas fa-trash" aria-hidden="true"></i>
            </button>
        </form>
    @endadmin
</div>

<style>
    .google-action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .google-action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: transparent;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
        padding: 0;
    }

    .google-action-view {
        color: #5f6368;
    }

    .google-action-view:hover {
        background: #e8eaed;
        color: #202124;
    }

    .google-action-edit {
        color: #1a73e8;
    }

    .google-action-edit:hover {
        background: #e8f0fe;
        color: #1967d2;
    }

    .google-action-delete {
        color: #d93025;
    }

    .google-action-delete:hover {
        background: #fce8e6;
        color: #c5221f;
    }
</style>

<div class="google-action-buttons">
    <!-- View Button -->
    <a href="{{ route('etudiants.show', $item) }}" 
       class="google-action-btn google-action-view" 
       title="{{ __('app.view') }}">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
            <path d="M8 2C4.5 2 1.5 4.5 0 8c1.5 3.5 4.5 6 8 6s6.5-2.5 8-6c-1.5-3.5-4.5-6-8-6zm0 10c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zm0-6.5c-1.4 0-2.5 1.1-2.5 2.5s1.1 2.5 2.5 2.5 2.5-1.1 2.5-2.5-1.1-2.5-2.5-2.5z"/>
        </svg>
    </a>
    
    <!-- Edit Button -->
    @admin
        <a href="{{ route('etudiants.edit', $item) }}" 
           class="google-action-btn google-action-edit" 
           title="{{ __('app.edit') }}">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
            </svg>
        </a>
    @endadmin
    
    <!-- Delete Button -->
    @admin
        <form action="{{ route('etudiants.destroy', $item) }}" 
              method="POST" 
              class="d-inline">
            @csrf
            @method('DELETE')
            <button type="button" 
                    class="google-action-btn google-action-delete delete-student" 
                    title="{{ __('app.delete') }}"
                    data-student-name="{{ $item->prenom }} {{ $item->nom }}">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
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

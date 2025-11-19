<div class="dropdown">
    <button class="google-icon-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="event.stopPropagation()">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
            <circle cx="10" cy="4" r="1.5"/>
            <circle cx="10" cy="10" r="1.5"/>
            <circle cx="10" cy="16" r="1.5"/>
        </svg>
    </button>
    <ul class="dropdown-menu dropdown-menu-end google-dropdown">
        <li>
            <a class="dropdown-item google-dropdown-item" href="{{ route('evaluations.show', $evaluation->id_evaluation) }}">
                {{ __('Voir les notes') }}
            </a>
        </li>
        @admin
        <li>
            <a class="dropdown-item google-dropdown-item" href="{{ route('evaluations.edit', $evaluation->id_evaluation) }}">
                {{ __('Modifier') }}
            </a>
        </li>
        <li><hr class="google-dropdown-divider"></li>
        <li>
            <form method="POST" action="{{ route('evaluations.destroy', $evaluation->id_evaluation) }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="button" class="dropdown-item google-dropdown-item google-dropdown-item-danger delete-evaluation" 
                        data-evaluation-id="{{ $evaluation->id_evaluation }}">
                    {{ __('Supprimer') }}
                </button>
            </form>
        </li>
        @endadmin
    </ul>
</div>

<style>
    .google-icon-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: transparent;
        color: #5f6368;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
    }

    .google-icon-btn:hover {
        background: #f1f3f4;
        color: #202124;
    }

    .google-dropdown {
        border: 1px solid #dadce0;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(60, 64, 67, 0.15);
        padding: 8px 0;
        min-width: 180px;
    }

    .google-dropdown-item {
        padding: 10px 16px;
        font-size: 0.875rem;
        color: #202124;
        transition: all 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
        border: none;
        background: none;
        width: 100%;
        text-align: left;
    }

    .google-dropdown-item:hover {
        background: #f1f3f4;
        color: #202124;
    }

    .google-dropdown-item:active {
        background: #e8eaed;
    }

    .google-dropdown-item-danger {
        color: #d93025;
    }

    .google-dropdown-item-danger:hover {
        background: #fce8e6;
        color: #c5221f;
    }

    .google-dropdown-divider {
        border-top: 1px solid #dadce0;
        margin: 8px 0;
    }
</style>

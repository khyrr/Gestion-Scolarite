<a href="{{ route('admin.classes.show', $item->id_classe) }}" 
   class="google-action-btn google-action-view"
   title="{{ __('app.voir') }}"
   aria-label="Voir la classe {{ $item->nom_classe }}">
    <x-icon name="actions/view" :size="18" label="Voir" />
</a>

@admin
<a href="{{ route('admin.classes.edit', $item->id_classe) }}" 
   class="google-action-btn google-action-edit"
   title="{{ __('app.modifier') }}"
   aria-label="Modifier la classe {{ $item->nom_classe }}">
    <x-icon name="actions/edit" :size="18" label="Modifier" />
</a>

<form action="{{ route('admin.classes.destroy', $item->id_classe) }}" 
      method="POST" 
      style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="button"
            class="google-action-btn google-action-delete delete-class"
            data-class-name="{{ $item->nom_classe }}"
            title="{{ __('app.supprimer') }}"
            aria-label="Supprimer la classe {{ $item->nom_classe }}">
        <x-icon name="actions/delete" :size="18" label="Supprimer" />
    </button>
</form>
@endadmin

<style>
.google-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: none;
    background: transparent;
    cursor: pointer;
    transition: background-color 0.2s cubic-bezier(0.4, 0.0, 0.2, 1);
    color: #5f6368;
    padding: 0;
    text-decoration: none;
}

.google-action-btn:hover {
    background-color: #f1f3f4;
}

.google-action-view:hover {
    color: #5f6368;
}

.google-action-edit:hover {
    color: #1a73e8;
}

.google-action-delete:hover {
    color: #d93025;
}

.google-action-btn svg {
    display: block;
}
</style>

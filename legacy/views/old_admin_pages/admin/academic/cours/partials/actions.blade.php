{{-- Courses Actions Partial --}}
@admin
<a href="{{ route('admin.cours.edit', $course->id_cours) }}" 
   class="google-action-btn google-action-edit"
   title="{{ __('app.modifier') }}"
   aria-label="Modifier le cours {{ $course->nom_cours }}">
    <x-icon name="actions/edit" :size="18" label="Modifier" />
</a>

<form action="{{ route('admin.cours.destroy', $course->id_cours) }}" 
      method="POST" 
      style="display: inline;"
      onsubmit="return confirm('{{ __('app.confirmer_suppression_cours') }}')">
    @csrf
    @method('DELETE')
    <button type="submit" 
            class="google-action-btn google-action-delete"
            title="{{ __('app.supprimer') }}"
            aria-label="Supprimer le cours {{ $course->nom_cours }}">
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
}

.google-action-btn:hover {
    background-color: #f1f3f4;
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

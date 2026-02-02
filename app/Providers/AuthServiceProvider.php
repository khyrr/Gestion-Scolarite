<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Etudiant::class => \App\Policies\EtudiantPolicy::class,
        \App\Models\Enseignant::class => \App\Policies\EnseignantPolicy::class,
        \App\Models\Evaluation::class => \App\Policies\EvaluationPolicy::class,
        \App\Models\Note::class => \App\Policies\NotePolicy::class,
        \App\Models\Classe::class => \App\Policies\ClassePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}

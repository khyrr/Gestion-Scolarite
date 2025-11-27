<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Route Model Bindings
        $this->configureModelBindings();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure route model bindings.
     */
    protected function configureModelBindings(): void
    {
        Route::model('classe', \App\Models\Classe::class);
        Route::model('etudiant', \App\Models\Etudiant::class);
        Route::model('enseignant', \App\Models\Enseignant::class);
        Route::model('cours', \App\Models\Cours::class);
        Route::model('evaluation', \App\Models\Evaluation::class);
        Route::model('note', \App\Models\Note::class);
        Route::model('etudePaiement', \App\Models\EtudePaiement::class);
        Route::model('enseignPaiement', \App\Models\EnseignPaiement::class);

        // Custom bindings for primary keys that are not 'id'
        Route::bind('classe', function ($value) {
            return \App\Models\Classe::where('id_classe', $value)->firstOrFail();
        });

        Route::bind('etudiant', function ($value) {
            return \App\Models\Etudiant::where('matricule', $value)->firstOrFail();
        });

        Route::bind('enseignant', function ($value) {
            return \App\Models\Enseignant::where('id_enseignant', $value)->firstOrFail();
        });

        Route::bind('cours', function ($value) {
            return \App\Models\Cours::where('id_cours', $value)->firstOrFail();
        });

        Route::bind('evaluation', function ($value) {
            return \App\Models\Evaluation::where('id_evaluation', $value)->firstOrFail();
        });

        Route::bind('note', function ($value) {
            return \App\Models\Note::where('id_note', $value)->firstOrFail();
        });
    }
}

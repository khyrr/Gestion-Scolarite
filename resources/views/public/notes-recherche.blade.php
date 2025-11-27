<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Recherche de Notes - {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .search-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }
        
        .search-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .search-body {
            padding: 2rem;
        }
        
        .results-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="search-card">
                    <div class="search-header">
                        <div class="mb-3">
                            <i class="fas fa-search fa-3x"></i>
                        </div>
                        <h2 class="mb-2">Recherche de Notes</h2>
                        <p class="mb-0 opacity-75">Entrez votre ID ou email pour consulter vos notes</p>
                    </div>
                    
                    <div class="search-body">
                        <form method="POST" action="{{ route('rechercher-notes.submit') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="id_etudiant" class="form-label">ID Étudiant ou Email</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input 
                                        type="text" 
                                        class="form-control @error('id_etudiant') is-invalid @enderror" 
                                        id="id_etudiant" 
                                        name="id_etudiant" 
                                        value="{{ old('id_etudiant') }}"
                                        placeholder="Votre ID ou adresse email..."
                                        required
                                    >
                                    @error('id_etudiant')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-search me-2"></i>
                                    Rechercher mes notes
                                </button>
                            </div>
                        </form>
                        
                        @if(session('error'))
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <div class="text-center mt-4">
                            <p class="text-muted">
                                Vous êtes un enseignant?
                                <a href="{{ route('enseignant.connexion') }}" class="text-decoration-none">
                                    Se connecter
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                
                @if(isset($student) && isset($notes))
                    <div class="results-card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-user-graduate me-2"></i>
                                Résultats pour: {{ $student->prenom }} {{ $student->nom }}
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($student->classe)
                                <div class="mb-3">
                                    <strong>Classe:</strong> {{ $student->classe->nom_classe }} 
                                    (Niveau {{ $student->classe->niveau }})
                                </div>
                            @endif
                            
                            @if($notes->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Matière</th>
                                                <th>Évaluation</th>
                                                <th>Type</th>
                                                <th>Note</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($notes as $note)
                                                <tr>
                                                    <td>
                                                        <span class="badge bg-secondary">
                                                            {{ $note->cours->matiere ?? 'N/A' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $note->evaluation->titre ?? 'N/A' }}</td>
                                                    <td>
                                                        @if($note->evaluation)
                                                            <span class="badge bg-{{ $note->evaluation->type == 'examen' ? 'danger' : 'info' }}">
                                                                {{ ucfirst($note->evaluation->type) }}
                                                            </span>
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-{{ $note->note >= 10 ? 'success' : 'danger' }} fs-6">
                                                            {{ $note->note }}/20
                                                        </span>
                                                    </td>
                                                    <td>{{ $note->created_at->format('d/m/Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <h6 class="card-title">Moyenne Générale</h6>
                                                    <h3 class="text-primary">
                                                        {{ round($notes->avg('note'), 2) }}/20
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <h6 class="card-title">Total Notes</h6>
                                                    <h3 class="text-info">{{ $notes->count() }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-clipboard text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-3">Aucune note disponible pour cet étudiant.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Mes Comptes</h2>
        <a href="{{ route('comptes.create') }}" class="btn btn-primary">Créer un compte</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse ($comptes as $compte)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">RIB: {{ $compte->rib }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <strong>Solde:</strong> {{ number_format($compte->solde, 2) }} €
                        </p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('comptes.show', $compte) }}" class="btn btn-info btn-sm">Voir détails</a>
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#depotModal{{ $compte->id }}">Déposer</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de dépôt -->
            <div class="modal fade" id="depotModal{{ $compte->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Déposer de l'argent</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('comptes.deposer', $compte) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Montant (€)</label>
                                    <input type="number" name="montant" class="form-control" step="0.01" min="0.01" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-success">Déposer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Vous n'avez pas encore de compte. <a href="{{ route('comptes.create') }}">Créer votre premier compte</a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
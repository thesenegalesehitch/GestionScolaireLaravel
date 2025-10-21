@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Détails du compte</h4>
                        <a href="{{ route('comptes.index') }}" class="btn btn-secondary btn-sm">← Retour</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>RIB:</strong> {{ $compte->rib }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p><strong>Solde actuel:</strong> <span class="h5 text-success">{{ number_format($compte->solde, 2) }} €</span></p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Actions</h5>
                            <div class="d-grid gap-2">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#depotModal">
                                    <i class="fas fa-plus-circle"></i> Déposer de l'argent
                                </button>
                                <a href="{{ route('transferts.create', ['compte_source' => $compte->id]) }}" class="btn btn-primary">
                                    <i class="fas fa-exchange-alt"></i> Transférer
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Historique récent</h5>
                            <div class="list-group">
                                <!-- Ici on pourrait afficher les dernières transactions -->
                                <div class="list-group-item text-muted">
                                    <small>Aucune transaction récente</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de dépôt -->
    <div class="modal fade" id="depotModal" tabindex="-1">
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
</div>
@endsection
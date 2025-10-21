@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Tableau de bord</h1>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Actions rapides</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('comptes.create') }}" class="btn btn-primary w-100">
                                <i class="fas fa-plus-circle me-2"></i>
                                Nouveau compte
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('transferts.create') }}" class="btn btn-success w-100">
                                <i class="fas fa-paper-plane me-2"></i>
                                Faire un transfert
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('contacts.create') }}" class="btn btn-info w-100">
                                <i class="fas fa-user-plus me-2"></i>
                                Ajouter contact
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('transferts.index') }}" class="btn btn-secondary w-100">
                                <i class="fas fa-history me-2"></i>
                                Historique
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Summary -->
    @if(auth()->user()->comptes->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Vos comptes</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @foreach(auth()->user()->comptes as $compte)
                        <div class="col-md-4">
                            <div class="card border">
                                <div class="card-body text-center">
                                    <h6 class="card-title">{{ $compte->rib }}</h6>
                                    <h4 class="text-success">{{ number_format($compte->solde, 2) }} €</h4>
                                    <small class="text-muted">Solde actuel</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Activity -->
    @if(auth()->user()->transferts->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Transferts récents</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Montant</th>
                                    <th>Destinataire</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(auth()->user()->transferts->take(5) as $transfert)
                                <tr>
                                    <td>{{ $transfert->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-success">{{ number_format($transfert->montant, 2) }} €</td>
                                    <td>{{ $transfert->contact_name ?: 'N/A' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('transferts.index') }}" class="btn btn-outline-primary">
                            Voir tout l'historique
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Mes Transferts</h2>
        <a href="{{ route('transferts.create') }}" class="btn btn-primary">Nouveau transfert</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Historique des transferts</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Destinataire</th>
                            <th>Montant</th>
                            <th>Compte source</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transferts as $transfert)
                            <tr>
                                <td>{{ $transfert->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    {{ $transfert->contact_name ?: 'N/A' }}
                                    @if($transfert->contact_email)
                                        <br><small class="text-muted">{{ $transfert->contact_email }}</small>
                                    @endif
                                </td>
                                <td><strong>{{ number_format($transfert->montant, 0, ',', ' ') }} FCFA</strong></td>
                                <td>{{ $transfert->rib_source }}</td>
                                <td>
                                    <span class="badge bg-success">Effectué</span>
                                </td>
                                <td>
                                    <form action="{{ route('transferts.destroy', $transfert->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce transfert ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-exchange-alt fa-2x mb-3 text-muted"></i>
                                    <br>
                                    Aucun transfert effectué pour le moment.
                                    <br>
                                    <a href="{{ route('transferts.create') }}" class="btn btn-primary btn-sm mt-2">Faire votre premier transfert</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
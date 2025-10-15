@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="text-center mb-4">Gestion des Transferts</h2>

    {{-- Messages flash --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulaire d'ajout d'un transfert --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Nouveau Transfert</div>
        <div class="card-body">
            <form action="{{ route('transferts.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Montant (€)</label>
                    <input type="number" name="montant" class="form-control" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">RIB Source</label>
                    <input type="text" name="rib_source" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">RIB Destination</label>
                    <input type="text" name="rib_destination" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Créer le transfert</button>
            </form>
        </div>
    </div>

    {{-- Tableau des transferts --}}
    <div class="card">
        <div class="card-header bg-secondary text-white">Historique des transferts</div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Montant</th>
                        <th>RIB Source</th>
                        <th>RIB Destination</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transferts as $transfert)
                        <tr>
                            <td>{{ $transfert->id }}</td>
                            <td>{{ $transfert->montant }}</td>
                            <td>{{ $transfert->rib_source }}</td>
                            <td>{{ $transfert->rib_destination }}</td>
                            <td>{{ $transfert->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                <form action="{{ route('transferts.destroy', $transfert->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Aucun transfert enregistré</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

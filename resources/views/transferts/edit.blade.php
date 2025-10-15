@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-indigo-800 mb-4">Modifier le Transfert #{{ $transfert->id }}</h2>

    <form method="POST" action="{{ route('transferts.update', $transfert) }}" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Montant (€)</label>
            <input type="number" step="0.01" name="montant" class="form-control" value="{{ old('montant', $transfert->montant) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">RIB Source</label>
            <input type="text" name="rib_source" class="form-control" value="{{ old('rib_source', $transfert->rib_source) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">RIB Destination</label>
            <input type="text" name="rib_destination" class="form-control" value="{{ old('rib_destination', $transfert->rib_destination) }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('transferts.index') }}" class="btn btn-secondary">↩ Retour</a>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-indigo-800 mb-4">Nouveau Transfert</h2>

    <form method="POST" action="{{ route('transferts.store') }}" class="bg-white p-4 rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Montant (€)</label>
            <input type="number" step="0.01" name="montant" class="form-control" value="{{ old('montant') }}">
            @error('montant') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">RIB Source</label>
            <input type="text" name="rib_source" class="form-control" value="{{ old('rib_source') }}">
            @error('rib_source') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">RIB Destination</label>
            <input type="text" name="rib_destination" class="form-control" value="{{ old('rib_destination') }}">
            @error('rib_destination') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('transferts.index') }}" class="btn btn-secondary">↩ Retour</a>
    </form>
</div>
@endsection

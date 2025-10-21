@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Créer un nouveau compte</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('comptes.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="rib" class="form-label">RIB (Relevé d'Identité Bancaire)</label>
                            <input type="text" class="form-control @error('rib') is-invalid @enderror"
                                   id="rib" name="rib" value="{{ old('rib') }}" required maxlength="30">
                            @error('rib')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Créer le compte</button>
                            <a href="{{ route('comptes.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
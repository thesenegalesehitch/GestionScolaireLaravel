@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">BankApp</h1>

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
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('transferts.create') }}" class="btn btn-success w-100 btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>
                                Faire un transfert
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('transferts.index') }}" class="btn btn-primary w-100 btn-lg">
                                <i class="fas fa-history me-2"></i>
                                Historique des transferts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Summary -->
    @if(auth()->user()->comptes->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Votre compte</h5>
                </div>
                <div class="card-body">
                    @foreach(auth()->user()->comptes as $compte)
                    <div class="text-center">
                        <h6 class="text-muted">{{ $compte->rib }}</h6>
                        <h2 class="text-success mb-0">{{ number_format($compte->solde, 0, ',', ' ') }} FCFA</h2>
                        <small class="text-muted">Solde disponible</small>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

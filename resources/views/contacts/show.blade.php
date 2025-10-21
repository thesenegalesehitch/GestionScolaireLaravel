@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Détails du contact</h4>
                    <div>
                        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('contacts.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary">{{ $contact->full_name }}</h5>
                            <hr>
                            <dl class="row">
                                <dt class="col-sm-4">Prénom:</dt>
                                <dd class="col-sm-8">{{ $contact->first_name }}</dd>

                                <dt class="col-sm-4">Nom:</dt>
                                <dd class="col-sm-8">{{ $contact->last_name }}</dd>

                                <dt class="col-sm-4">Téléphone:</dt>
                                <dd class="col-sm-8">
                                    @if($contact->phone)
                                        <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </dd>

                                <dt class="col-sm-4">Adresse:</dt>
                                <dd class="col-sm-8">
                                    @if($contact->address)
                                        {{ $contact->address }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h6>Informations bancaires</h6>
                            <hr>
                            <dl class="row">
                                <dt class="col-sm-4">RIB:</dt>
                                <dd class="col-sm-8">
                                    <code class="text-primary">{{ $contact->rib }}</code>
                                </dd>
                            </dl>

                            <div class="mt-4">
                                <a href="{{ route('transferts.create', ['contact' => $contact->id]) }}"
                                   class="btn btn-success w-100">
                                    <i class="fas fa-paper-plane"></i> Faire un transfert
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

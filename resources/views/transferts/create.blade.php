@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Effectuer un transfert</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('transferts.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="rib_source" class="form-label">Compte source</label>
                            <select name="rib_source" id="rib_source" class="form-control" required>
                                <option value="">Sélectionnez un compte</option>
                                @foreach($comptes as $compte)
                                    <option value="{{ $compte->rib }}"
                                            {{ ($compteSource && $compteSource->id == $compte->id) ? 'selected' : '' }}>
                                        {{ $compte->rib }} (Solde: {{ number_format($compte->solde, 2) }} €)
                                    </option>
                                @endforeach
                            </select>
                            @error('rib_source') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Sélection du contact destinataire -->
                        <div class="mb-3">
                            <label for="contact_id" class="form-label">Sélectionner un contact destinataire <span class="text-danger">*</span></label>
                            <select name="contact_id" id="contact_id" class="form-control @error('contact_id') is-invalid @enderror" required>
                                <option value="">Choisissez un contact...</option>
                                @foreach($contacts as $contact)
                                    <option value="{{ $contact->id }}"
                                            data-name="{{ $contact->full_name }}"
                                            data-phone="{{ $contact->phone }}"
                                            data-rib="{{ $contact->rib }}">
                                        {{ $contact->full_name }} - {{ $contact->phone ?: 'Pas de téléphone' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('contact_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <small>Sélectionnez un contact existant. <a href="{{ route('contacts.create') }}" target="_blank">Ajouter un nouveau contact</a></small>
                            </div>
                        </div>

                        <!-- Informations du destinataire (remplies automatiquement) -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contact_name" class="form-label">Nom du destinataire</label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name"
                                       value="{{ old('contact_name') }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_phone" class="form-label">Téléphone du destinataire</label>
                                <input type="tel" class="form-control" id="contact_phone" name="contact_phone"
                                       value="{{ old('contact_phone') }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="rib_destination" class="form-label">RIB Destination <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rib_destination') is-invalid @enderror"
                                   id="rib_destination" name="rib_destination" value="{{ old('rib_destination') }}" required maxlength="30">
                            @error('rib_destination')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="montant" class="form-label">Montant (€) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="montant" id="montant" class="form-control @error('montant') is-invalid @enderror"
                                   value="{{ old('montant') }}" min="0.01" required>
                            @error('montant')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Effectuer le transfert</button>
                            <a href="{{ route('transferts.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactSelect = document.getElementById('contact_id');
    const contactName = document.getElementById('contact_name');
    const contactPhone = document.getElementById('contact_phone');
    const ribDestination = document.getElementById('rib_destination');

    contactSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];

        if (this.value) {
            // Remplir automatiquement les champs avec les données du contact sélectionné
            contactName.value = selectedOption.getAttribute('data-name') || '';
            contactPhone.value = selectedOption.getAttribute('data-phone') || '';
            ribDestination.value = selectedOption.getAttribute('data-rib') || '';
        } else {
            // Vider les champs si aucun contact n'est sélectionné
            contactName.value = '';
            contactPhone.value = '';
            ribDestination.value = '';
        }
    });
});
</script>
@endsection
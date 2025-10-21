@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Mes Contacts</h2>
        <a href="{{ route('contacts.create') }}" class="btn btn-primary">Ajouter un contact</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Liste de mes contacts bancaires</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nom complet</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>RIB</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                            <tr>
                                <td>
                                    <a href="{{ route('contacts.show', $contact) }}" class="text-decoration-none">
                                        <strong>{{ $contact->full_name }}</strong>
                                    </a>
                                </td>
                                <td>
                                    @if($contact->phone)
                                        <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($contact->address)
                                        <small class="text-muted">{{ Str::limit($contact->address, 50) }}</small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <code class="text-primary">{{ $contact->rib }}</code>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-outline-info">
                                            Voir
                                        </a>
                                        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-outline-warning">
                                            Modifier
                                        </a>
                                        <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-address-book fa-2x mb-3 text-muted"></i>
                                    <br>
                                    Aucun contact enregistré pour le moment.
                                    <br>
                                    <a href="{{ route('contacts.create') }}" class="btn btn-primary btn-sm mt-2">
                                        Ajouter votre premier contact
                                    </a>
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

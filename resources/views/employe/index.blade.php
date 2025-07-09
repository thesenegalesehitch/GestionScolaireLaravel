<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        {{-- Message de succès --}}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <hr>
        <h3 class="text-center text-uppercase">Liste des employés</h3>
        <hr>

        {{-- Bouton d'ajout --}}
        <a class="btn btn-primary mb-3" href="{{ url('/ajouter-employe') }}">Ajouter un employé</a>

        {{-- Tableau des employés --}}
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Poste</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employes as $employe)
                    <tr>
                        <td>{{ $employe->id }}</td>
                        <td>{{ $employe->prenom }}</td>
                        <td>{{ $employe->nom }}</td>
                        <td>{{ $employe->poste }}</td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{ url('/update-employe/' . $employe->id) }}">Modifier</a>
                            <a class="btn btn-danger btn-sm"
                               href="{{ url('/delete-employe/' . $employe->id) }}"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?');">
                               Supprimer
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucun employé trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</body>

</html>

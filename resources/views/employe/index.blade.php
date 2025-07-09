<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <hr>
        <h3 class="text-center text-uppercase">Liste des employes</h3>
        <hr>
        <br>
        <a href="/ajouter" class="btn btn-primary">Ajouter un employe</a>
        <br>
        @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Fonction</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employes as $employe)
                <tr>
                    <th scope="row">{{$employe->id}}</th>
                    <td>{{$employe->prenom}}</td>
                    <td>{{$employe->nom}}</td>
                    <td>{{$employe->fonction}}</td>
                    <td>
                        <a class="btn btn-warning" href="update-employe/{{$employe->id}}">Update</a>
                        <a class="btn btn-danger" href="">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</body>

</html>
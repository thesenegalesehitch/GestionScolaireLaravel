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
        @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
        <br>
        <form action="/update" method="post">
            @csrf
            <input type="hidden" name="id" value=" {{$etudiant->id}}">
            <div class=" form-group">
                <label for="prenom" class="form-label">Prenom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="{{$etudiant->prenom}}">
            </div>
            <div class="form-group">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{$etudiant->nom}}">
            </div>
            <div class="form-group">
                <label for="classe" class="form-label">Classe</label>
                <input type="text" class="form-control" id="classe" name="classe" value="{{$etudiant->classe}}">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</body>

</html>
<!doctype html>
<html lang="fr">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inscription</title>
    </head>
    <body>
        <div class="container w-75 h-50 border rounded p-2 bg-black-50">
        <hr>
            <div class="text-primary "><h3>Sign in</h3></div>
        </hr>
        @csrf
            <form action ="inscrire" method="post">
                @csrf
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control w-50 id="prenom" name="prenom" placeholder="Mettez votre prénom !">
                </div>
                <br>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control w-50" id="nom" name="nom" placeholder="Mettez votre nom !">
                </div>
                @error('nom')
                     <div style="color:red">{{ $message }}</div>
                @enderror
                <br>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control w-50" id="email" name="email" placeholder="monEmail@exemple.com">
                </div>
                @error('email')
                    <div style="color:red">{{ $message }}</div>
                @enderror
                <br>
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" class="form-control w-50" id="telephone" name="telephone" placeholder="771234567">
                </div>
                <br>
                <div class="form-group">
                    <label for="adress">Adress</label>
                    <input type="text" class="form-control w-50" id="adress" name="adress" placeholder="adress">
                </div>
                <br>
                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" class="form-control w-50" id="mdp" name="mdp" placeholder="">
                </div>
                <br>
                <div class="form-group">
                    <label for="mdp">Confirmer mot de passe</label>
                    <input type="password" class="form-control w-50" id="confMdp" name="confMdp" placeholder="">
                </div>
                <br>
                <input type="submit" value="Inscrire" name="inscrire" class="btn btn-primary my-2 w-50">
                <br>
                <a href="/login">Vous avez un compte?</a>

            </form>
        </div>
    </body>
</html>
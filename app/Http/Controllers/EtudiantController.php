<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    //affiche la list de tous ls etudiants
    public function liste()
    {
        $etudiants = Etudiant::all(); //recupere tous ls etudiants depuis la BDD
        return view('etudiant.index', compact('etudiants')); //envoie a la vue index
    }

    //affiche le formulaire de creation d'1 nouvel etudiant
    public function creerEtudiant()
    {
        return view('etudiant.creer'); //retourne la vue de creation
    }

    //enregistre un nouvel etudiant en base
    public function enregistrerEtudiant(Request $request)
    {
        //validation des champs
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'classe' => 'required|string|max:100',
        ]);

        //creation de l'etudiant
        $etudiant = new Etudiant();
        $etudiant->prenom = htmlspecialchars($request->prenom); //protection XSS
        $etudiant->nom = htmlspecialchars($request->nom);
        $etudiant->classe = htmlspecialchars($request->classe);
        $etudiant->save(); //sauvegarde dans la BDD

        return redirect('etudiants')->with('status', 'Étudiant enregistré avec succès.');
    }

    //affiche le formulaire d'edition pour un etudiant
    public function editerEtudiant($id)
    {
        $etudiant = Etudiant::findOrFail($id); //recupere l'etudiant ou erreur 404
        return view('etudiant.edit', compact('etudiant'));
    }

    //MAJ les infos d'1 etudiant
    public function updateEtudiant(Request $request)
    {
        //validation des donnees
        $request->validate([
            'id' => 'required|exists:etudiants,id',
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'classe' => 'required|string|max:100',
        ]);

        $etudiant = Etudiant::findOrFail($request->id); //recuperation de l'etudiant
        $etudiant->prenom = htmlspecialchars($request->prenom);
        $etudiant->nom = htmlspecialchars($request->nom);
        $etudiant->classe = htmlspecialchars($request->classe);
        $etudiant->save(); // Ou $etudiant->update();

        return redirect('etudiants')->with('status', 'Étudiant mis à jour avec succès.');
    }

    //supprime un etudiant
    public function supprimerEtudiant($id)
    {
        $etudiant = Etudiant::findOrFail($id); //verifie l'existence
        $etudiant->delete(); //supprime de la BDD

        return redirect('etudiants')->with('status', 'Étudiant supprimé avec succès.');
    }
}

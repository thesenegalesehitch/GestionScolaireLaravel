<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function liste()
    {
        $employes = Employe::all();
        return view('employe.index', compact('employes'));
    }

    public function creerEmploye()
    {
        return view('employe.creer');
    }

    public function enregistrerEmploye(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:100',
        ]);

        $employe = new Employe();
        $employe->prenom = htmlspecialchars($request->prenom);
        $employe->nom = htmlspecialchars($request->nom);
        $employe->poste = htmlspecialchars($request->poste);
        $employe->save();

        return redirect('employes')->with('status', 'Employé enregistré avec succès.');
    }

    public function editerEmploye($id)
    {
        $employe = Employe::findOrFail($id);
        return view('employe.edit', compact('employe'));
    }

    public function updateEmploye(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:employes,id',
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:100',
        ]);

        $employe = Employe::findOrFail($request->id);
        $employe->prenom = htmlspecialchars($request->prenom);
        $employe->nom = htmlspecialchars($request->nom);
        $employe->poste = htmlspecialchars($request->poste);
        $employe->save();

        return redirect('employes')->with('status', 'Employé mis à jour avec succès.');
    }

    public function supprimerEmploye($id)
    {
        $employe = Employe::findOrFail($id);
        $employe->delete();

        return redirect('employes')->with('status', 'Employé supprimé avec succès.');
    }
}

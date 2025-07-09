<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use Illuminate\Http\Request;

class VoitureController extends Controller
{
    public function liste()
    {
        $voitures = Voiture::all();
        return view('voiture.index', compact('voitures'));
    }

    public function creerVoiture()
    {
        return view('voiture.creer');
    }

    public function enregistrerVoiture(Request $request)
    {
        $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        $voiture = new Voiture();
        $voiture->marque = htmlspecialchars($request->marque);
        $voiture->modele = htmlspecialchars($request->modele);
        $voiture->annee = $request->annee;
        $voiture->save();

        return redirect('voitures')->with('status', 'Voiture enregistrée avec succès.');
    }

    public function editerVoiture($id)
    {
        $voiture = Voiture::findOrFail($id);
        return view('voiture.edit', compact('voiture'));
    }

    public function updateVoiture(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:voitures,id',
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        $voiture = Voiture::findOrFail($request->id);
        $voiture->marque = htmlspecialchars($request->marque);
        $voiture->modele = htmlspecialchars($request->modele);
        $voiture->annee = $request->annee;
        $voiture->save();

        return redirect('voitures')->with('status', 'Voiture mise à jour avec succès.');
    }

    public function supprimerVoiture($id)
    {
        $voiture = Voiture::findOrFail($id);
        $voiture->delete();

        return redirect('voitures')->with('status', 'Voiture supprimée avec succès.');
    }
}

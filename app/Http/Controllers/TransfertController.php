<?php

namespace App\Http\Controllers;

use App\Models\Transfert;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Contrôleur TransfertController - Gère les transferts d'argent entre comptes
 * Permet la création, l'exécution et la gestion des transferts
 */
class TransfertController extends Controller
{
    /**
     * Affiche la liste des transferts de l'utilisateur connecté
     * Route: GET /transferts
     *
     * @return View
     */
    public function index(): View
    {
        // Récupère uniquement les transferts de l'utilisateur, triés par date décroissante
        $transferts = Transfert::where('user_id', auth()->id())->latest()->get();
        return view('transferts.index', compact('transferts'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau transfert
     * Route: GET /transferts/create
     *
     * @param Request $request Paramètres de requête (optionnel: compte_source)
     * @return View
     */
    public function create(Request $request): View
    {
        // Récupère les comptes de l'utilisateur
        $comptes = auth()->user()->comptes;
        $compteSource = null;

        // Si un compte source est spécifié dans l'URL, le présélectionner
        if ($request->has('compte_source')) {
            $compteSource = Compte::where('user_id', auth()->id())
                                ->where('id', $request->compte_source)
                                ->first();
        }

        // Récupère les contacts de l'utilisateur pour la recherche
        $contacts = auth()->user()->contacts;

        return view('transferts.create', compact('comptes', 'compteSource', 'contacts'));
    }

    /**
     * Enregistre et exécute un nouveau transfert
     * Route: POST /transferts
     *
     * @param Request $request Données du formulaire de transfert
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des données d'entrée
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0.01',                    // Montant positif requis
            'rib_source' => 'required|string|max:30|exists:comptes,rib', // RIB source doit exister
            'rib_destination' => 'required|string|max:30|different:rib_source', // RIB destination différent
            'contact_id' => 'required|exists:contacts,id',               // Contact doit exister
            'contact_name' => 'required|string|max:255',                 // Nom du destinataire requis
            'contact_phone' => 'nullable|string|max:20',                 // Téléphone optionnel
        ]);

        // Vérification que le compte source appartient bien à l'utilisateur
        $compteSource = Compte::where('rib', $validated['rib_source'])
                             ->where('user_id', auth()->id())
                             ->first();

        if (!$compteSource) {
            return back()->withErrors(['rib_source' => 'Compte source invalide.']);
        }

        // Vérification que le contact appartient bien à l'utilisateur
        $contact = \App\Models\Contact::where('id', $validated['contact_id'])
                                     ->where('user_id', auth()->id())
                                     ->first();

        if (!$contact) {
            return back()->withErrors(['contact_id' => 'Contact invalide.']);
        }

        // Associe le transfert à l'utilisateur connecté
        $validated['user_id'] = auth()->id();

        // Création du transfert en base
        $transfert = Transfert::create($validated);

        // Tentative d'exécution du transfert
        if ($transfert->execute()) {
            return redirect()->route('transferts.index')->with('success', 'Transfert effectué avec succès.');
        } else {
            // En cas d'échec, supprimer le transfert et retourner une erreur
            $transfert->delete();
            return back()->withErrors(['montant' => 'Solde insuffisant pour effectuer ce transfert.']);
        }
    }

    /**
     * Supprime un transfert de l'utilisateur
     * Route: DELETE /transferts/{id}
     *
     * @param int $id ID du transfert à supprimer
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        // Vérifie que le transfert appartient à l'utilisateur avant suppression
        $transfert = Transfert::where('user_id', auth()->id())->findOrFail($id);
        $transfert->delete();

        return redirect()->route('transferts.index')->with('success', 'Transfert supprimé.');
    }
}

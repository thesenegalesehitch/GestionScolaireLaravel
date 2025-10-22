<?php

namespace App\Http\Controllers;

use App\Models\Transfert;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


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
        $comptes = auth()->user()->comptes;
        $compteSource = null;

        if ($request->has('compte_source')) {
            $compteSource = Compte::where('user_id', auth()->id())
                                ->where('id', $request->compte_source)
                                ->first();
        }

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
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0.01',
            'rib_source' => 'required|string|max:30|exists:comptes,rib',
            'rib_destination' => 'required|string|max:30|different:rib_source',
            'contact_id' => 'required|exists:contacts,id',
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        $compteSource = Compte::where('rib', $validated['rib_source'])
                             ->where('user_id', auth()->id())
                             ->first();

        if (!$compteSource) {
            return back()->withErrors(['rib_source' => 'Compte source invalide.']);
        }

        $contact = \App\Models\Contact::where('id', $validated['contact_id'])
                                     ->where('user_id', auth()->id())
                                     ->first();

        if (!$contact) {
            return back()->withErrors(['contact_id' => 'Contact invalide.']);
        }

        $validated['user_id'] = auth()->id();

        $transfert = Transfert::create([
            'montant' => $validated['montant'],
            'rib_source' => $validated['rib_source'],
            'rib_destination' => $contact->rib,
            'user_id' => $validated['user_id'],
            'contact_name' => $contact->first_name . ' ' . $contact->last_name,
            'contact_email' => $contact->email,
        ]);

        if ($transfert->execute()) {
            return redirect()->route('transferts.index')->with('success', 'Transfert effectué avec succès.');
        } else {
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
        $transfert = Transfert::where('user_id', auth()->id())->findOrFail($id);
        $transfert->delete();

        return redirect()->route('transferts.index')->with('success', 'Transfert supprimé.');
    }
}

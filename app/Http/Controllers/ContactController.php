<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Contrôleur ContactController - Gère les contacts bancaires de l'utilisateur
 * Permet la gestion CRUD des contacts pour faciliter les transferts
 */
class ContactController extends Controller
{
    /**
     * Affiche la liste des contacts de l'utilisateur connecté
     * Route: GET /contacts
     *
     * @return View
     */
    public function index(): View
    {
        $contacts = auth()->user()->contacts; // Récupère uniquement les contacts de l'utilisateur
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau contact
     * Route: GET /contacts/create
     *
     * @return View
     */
    public function create(): View
    {
        return view('contacts.create');
    }

    /**
     * Enregistre un nouveau contact en base de données
     * Route: POST /contacts
     *
     * @param Request $request Données du formulaire
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des données d'entrée
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',     // Prénom obligatoire
            'last_name' => 'required|string|max:255',      // Nom obligatoire
            'phone' => 'nullable|string|max:20',           // Téléphone optionnel
            'address' => 'nullable|string|max:500'         // Adresse optionnelle
        ]);

        // Associe le contact à l'utilisateur connecté
        $validated['user_id'] = auth()->id();

        // Génère un RIB unique
        $validated['rib'] = Contact::generateUniqueRib();

        // Création du contact
        Contact::create($validated);

        // Redirection avec message de succès
        return redirect()->route('contacts.index')->with('success', 'Contact ajouté avec succès');
    }

    /**
     * Affiche les détails d'un contact spécifique
     * Route: GET /contacts/{id}
     *
     * @param int $id ID du contact
     * @return View
     */
    public function show(int $id): View
    {
        // Vérifie que le contact appartient bien à l'utilisateur connecté
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    /**
     * Affiche le formulaire d'édition d'un contact
     * Route: GET /contacts/{id}/edit
     *
     * @param int $id ID du contact
     * @return View
     */
    public function edit(int $id): View
    {
        // Vérifie que le contact appartient bien à l'utilisateur connecté
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Met à jour un contact existant
     * Route: PUT /contacts/{id}
     *
     * @param Request $request Données du formulaire
     * @param int $id ID du contact
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        // Vérifie que le contact appartient bien à l'utilisateur connecté
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);

        // Validation des données d'entrée
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500'
        ]);

        // Mise à jour du contact
        $contact->update($validated);

        // Redirection avec message de succès
        return redirect()->route('contacts.index')->with('success', 'Contact modifié avec succès');
    }

    /**
     * Supprime un contact
     * Route: DELETE /contacts/{id}
     *
     * @param int $id ID du contact à supprimer
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        // Vérifie que le contact appartient bien à l'utilisateur connecté
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);
        $contact->delete();

        // Redirection avec message de succès
        return redirect()->route('contacts.index')->with('success', 'Contact supprimé avec succès');
    }
}

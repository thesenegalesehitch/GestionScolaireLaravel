<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


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
        $contacts = auth()->user()->contacts;
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
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500'
        ]);

        $validated['user_id'] = auth()->id();

        $validated['rib'] = Contact::generateUniqueRib();

        Contact::create($validated);

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
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500'
        ]);

        $contact->update($validated);

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
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact supprimé avec succès');
    }
}

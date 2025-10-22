<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Contrôleur CompteController - Gère les opérations sur les comptes bancaires
 * Fournit les fonctionnalités CRUD pour les comptes utilisateur
 */
class CompteController extends Controller
{
    /**
     * Affiche la liste des comptes de l'utilisateur connecté
     * Route: GET /comptes
     *
     * @return View
     */
    public function index(): View
    {
        $comptes = auth()->user()->comptes;
        return view('comptes.index', compact('comptes'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau compte
     * Route: GET /comptes/create
     *
     * @return View
     */
    public function create(): View
    {
        return view('comptes.create');
    }

    /**
     * Enregistre un nouveau compte en base de données
     * Route: POST /comptes
     *
     * @param Request $request Données du formulaire
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'rib' => 'required|string|max:30|unique:comptes,rib',
        ]);

        $validated['user_id'] = auth()->id();

        Compte::create($validated);

        return redirect()->route('comptes.index')->with('success', 'Compte créé avec succès');
    }

    /**
     * Affiche les détails d'un compte spécifique
     * Route: GET /comptes/{id}
     *
     * @param int $id ID du compte
     * @return View
     */
    public function show(int $id): View
    {
        $compte = Compte::where('user_id', auth()->id())->findOrFail($id);
        return view('comptes.show', compact('compte'));
    }

    /**
     * Effectue un dépôt sur un compte
     * Route: POST /comptes/{id}/deposer
     *
     * @param Request $request Données du formulaire
     * @param int $id ID du compte
     * @return RedirectResponse
     */
    public function deposer(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0.01',
        ]);

        $compte = Compte::where('user_id', auth()->id())->findOrFail($id);

        $compte->deposer($validated['montant']);

        return redirect()->route('comptes.show', $compte)->with('success', 'Dépôt effectué avec succès');
    }

    /**
     * Met à jour un compte (API - non utilisé dans l'interface web)
     * Route: PUT /comptes/{id}
     *
     * @param Request $request Données de mise à jour
     * @param int $id ID du compte
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $compte = Compte::findOrFail($id);

        $validated = $request->validate([
            'rib' => 'string|max:30|unique:comptes,rib,' . $compte->id,
            'user_id' => 'integer|exists:users,id',
        ]);

        $compte->update($validated);

        return response()->json([
            'message' => 'Compte mis à jour avec succès',
            'data' => $compte
        ]);
    }

    /**
     * Supprime un compte (API - non utilisé dans l'interface web)
     * Route: DELETE /comptes/{id}
     *
     * @param int $id ID du compte
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $compte = Compte::findOrFail($id);
        $compte->delete();

        return response()->json([
            'message' => 'Compte supprimé avec succès'
        ], 204);
    }
}

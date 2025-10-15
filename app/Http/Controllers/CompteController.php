<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CompteController extends Controller
{
    public function index(): JsonResponse
    {
        $comptes = Compte::all();
        return response()->json($comptes);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'rib' => 'required|string|max:30|unique:comptes,rib',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $compte = Compte::create($validated);

        return response()->json([
            'message' => 'Compte créé avec succès',
            'data' => $compte
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $compte = Compte::findOrFail($id);
        return response()->json($compte);
    }

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

    public function destroy(int $id): JsonResponse
    {
        $compte = Compte::findOrFail($id);
        $compte->delete();

        return response()->json([
            'message' => 'Compte supprimé avec succès'
        ], 204);
    }
}

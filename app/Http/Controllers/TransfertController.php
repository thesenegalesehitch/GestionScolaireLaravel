<?php

namespace App\Http\Controllers;

use App\Models\Transfert;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class TransfertController extends Controller
{
    public function index()
    {
        $transferts = Transfert::all();
        return view('transferts.index', compact('transferts'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0.01',
            'rib_source' => 'required|string|max:30',
            'rib_destination' => 'required|string|max:30|different:rib_source',
        ]);

        Transfert::create($validated);

        return redirect()->route('transferts.index')->with('success', 'Transfert créé avec succès.');
    }

    public function destroy($id): RedirectResponse
    {
        $transfert = Transfert::findOrFail($id);
        $transfert->delete();

        return redirect()->route('transferts.index')->with('success', 'Transfert supprimé.');
    }
}

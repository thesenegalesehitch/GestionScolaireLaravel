<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function ajouter(){
        return view('employe.create');
    }

    public function traitement(Request $request){
        $request->validate([
                'prenom'=>'required',
                'nom'=>'required',
                'fonction'=>'required'
            ]);
        $employe = new Employe();
        $employe->nom = $request->nom;
        $employe->prenom = $request->prenom;
        $employe->fonction = $request->fonction;
        $employe->save();
        return redirect('ajouter')->with('status',"Employe ajouté avec success");
    }

    public function edit($id){
        $employe = Employe::find($id);
        
        return view('employe.edit', compact('employe'));
    }

    public function liste() {
        $employes = Employe::all();
        return view('employe.index', compact('employes'));
    }

    public function update(Request $request) {
        $request->validate([
            'prenom'=>'required',
            'nom'=>'required',
            'fonction'=>'required'
        ]);
    $employe = Employe::find($request->id);
    $employe->nom = $request->nom;
    $employe->prenom = $request->prenom;
    $employe->fonction = $request->fonction;
    $employe->update();
    return redirect('/liste')->with('status',"Employe mis a jour avec success");
    }
}
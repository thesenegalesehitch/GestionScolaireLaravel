<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function inscriptionUser(){
        return view('inscription');
    }

    public function inscriptionPage(Request $request) {

        $messages = [
            'nom.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'L\'adresse e-mail doit être valide.',
            'email.unique' => 'L\'adresse e-mail existe déjà.'
        ];

        $request->validate([
            'nom'=>'required|max:50',
            'email'=>'required|email|max:100'

        ],$messages);
        return back()->with('succes','Vos données sont enregistrer avec succes');
    }

    public function connecterPage(){
        return view('connection');
    }

    public function forgetPage(){
        return view('forget');
    }

    public function reinitialisationPage(){
        return view('reset');
    }

    public function accueilPage(){
        return view('home');
    }

//     public function inscrire(Request $request){
//       return view('login',compact('request'));
//         return redirect("login",compact('request'));
//     }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    //
    public function etudiants(){
        return view('les-etudiants');
    }
}

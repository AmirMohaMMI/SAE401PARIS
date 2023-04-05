<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JOUEURS;

class JOUEURSController extends Controller{

    public function list(Request $request)
    {
     $joueurs = JOUEURS::select("idjoueur", "nom", "prenom", "photo", "role", 'pseudo', 'idequipe')->get();          
    return response()->json($joueurs);
    }

}
    


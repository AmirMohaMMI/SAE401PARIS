<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\JOUEURS;

class JOUEURSController extends Controller{

    public function list(Request $request)
    {
     $joueurs = JOUEURS::select("idjoueur", "nom", "prenom", "photo", "role", 'pseudo', 'idequipe')->get();          
    return response()->json($joueurs);
    }


public function affichejoueurs($idequipe, $idjeu) {
    $joueurs = DB::table('JOUEURS')->select('nom', 'prenom', 'photo', 'pseudo')
                ->where('idequipe', $idequipe)
                ->where('idjeu', $idjeu)
                ->get();
    $result = [];
    foreach ($joueurs as $joueur) {
        $result[] = [
            'nom' => $joueur->nom,
            'prenom' => $joueur->prenom,
            'photo' => $joueur->photo,
            'pseudo' => $joueur->pseudo,
        ];
    }
    return $result;
}


public function affichedetailsjoueur($idjoueur) {
    $joueurs = DB::table('JOUEURS')->select('nom', 'prenom', 'photo', 'pseudo', 'role', 'description')
    ->where('idjoueur', $idjoueur)
    ->get();
    return response()->json($joueurs);
}
}
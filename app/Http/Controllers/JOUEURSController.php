<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\JOUEURS;

class JOUEURSController extends Controller{

    public function list(Request $request)
    {
     $joueurs = JOUEURS::select("idjoueur", "nom", "prenom", "photo", "role", 'pseudo', 'equipe')->get();          
    return response()->json($joueurs);
    }


public function affichejoueurs(Request $request) {
    $jeux = $request->jeux;
    $equipe = $request->equipe;
    $joueurs = JOUEURS::select("idjoueur", "nom", "prenom", "photo", "role", 'pseudo', 'equipe', 'jeux')        
    ->where('jeux', "like", '%'.$jeux.'%')
    ->where('equipe', "like", '%'.$equipe.'%')
    ->get();     
    return response()->json($joueurs);
   
}





//     DB::table('JOUEURS')->select('nom', 'prenom', 'photo', 'pseudo')
//             ->where('jeux', "like", '%'.$jeux.'%')
//                 ->where('idjeu', $idjeu)
//                 ->get();
//                 $rencontre = Rencontre::select('equipe1','equipe2','daterenc','cote_equipe1','cote_equipe2', 'jeux')
//                 ->where('jeux', "like", '%'.$jeux.'%')
//                 ->get();
//                 return response()->json($rencontre);
    
    
    
    
    
//                 $result = [];
//     foreach ($joueurs as $joueur) {
//         $result[] = [
//             'nom' => $joueur->nom,
//             'prenom' => $joueur->prenom,
//             'photo' => $joueur->photo,
//             'pseudo' => $joueur->pseudo,
//         ];
//     }
//     return $result;
// }


public function affichedetailsjoueur($idjoueur) {
    $joueurs = DB::table('JOUEURS')->select('nom', 'prenom', 'photo', 'pseudo', 'role', 'description')
    ->where('idjoueur', $idjoueur)
    ->get();
    return response()->json($joueurs);
}
}
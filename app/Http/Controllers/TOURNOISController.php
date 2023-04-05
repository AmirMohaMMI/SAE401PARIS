<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournois;
use Validator;

class TournoisController extends Controller {

//Liste tous les tournois
public function ListeTournois(Request $request)
{
$tournois = Tournois::select('idtournois','jeux','nom_tournois')->get();
return response()->json($tournois);
}

//  AJOUTER UN TOURNOIS

public function AjouterTournois(Request $request) {

    $validator = Validator::make($request->all(),[        
        'nom_tournois' => 'required|string',
        'jeux' => 'required|string',
         ]);

         if ($validator->fails()) {
            return response()->json(["status" => 0, "message" => $validator->errors()],400);
            }

    $tournois = new Tournois;
    
    $tournois->nom_tournois = $request->nom_tournois;
    $tournois->jeux = $request->jeux;
    $ok = $tournois->save();
        if ($ok) {
    return response()->json(["status" => 1, "message" => "Le tournois ajouté"],201);
        } else {
        return response()->json(["status" => 0, "message" => "pb lors de
        l'ajout"],400);
        }
            
}

public function SupprimerTournois($idtournois) {
    $tournois = Tournois::find($idtournois); 
    $ok = $tournois->delete();
    if ($ok) {
        return response()->json(["status" => 1, "message" => "Tournois supprimé"],201);
        } else {
        return response()->json(["status" => 0, "message" => "Erreur, tournois non supprimé"],400);
        }
}
}
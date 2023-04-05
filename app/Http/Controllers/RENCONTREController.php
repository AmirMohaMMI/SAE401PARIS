<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rencontre;
use Validator;

class RENCONTREController extends Controller {

public function ListeRencontres(Request $request) {

    $rencontre = Rencontre::select('idrencontre','jeux','equipe1','equipe2', 'daterenc')->get();
    return response()->json($rencontre);
}

public function AjouterRencontre(Request $request) {

    $validator = Validator::make($request->all(),[        
        'jeux' => 'required|int',
        'equipe1' => 'required|int',
        'equipe2' => 'required|int',
        'daterenc' =>'required|date',
        'cote_equipe1' => 'required|int',
        'cote_equipe2' => 'required|int',
        'idtournois' => 'required|int',
         ]);

         if ($validator->fails()) {
            return response()->json(["status" => 0, "message" => $validator->errors()],400);
            }

    $rencontre = new Rencontre;
    
    $rencontre->jeux = $request->jeux;
    $rencontre->equipe1 = $request->equipe1;
    $rencontre->daterenc = $request->daterenc;
    $rencontre->cote_equipe1 = $request->cote_equipe1;
    $rencontre->cote_equipe2 = $request->cote_equipe2;
    $rencontre->idtournois = $request->idtournois;

    $ok = $rencontre->save();
        if ($ok) {
    return response()->json(["status" => 1, "message" => "LA rencontre a été ajoutée"],201);
        } else {
        return response()->json(["status" => 0, "message" => "pb lors de
        l'ajout"],400);
        }
            
}
}
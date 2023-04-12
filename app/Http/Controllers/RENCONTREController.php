<?php

namespace App\Http\Controllers;
use App\Models\EQUIPE;
use Illuminate\Http\Request;
use App\Models\RENCONTRE;
use Validator;
use Illuminate\Support\Facades\Log;
class RENCONTREController extends Controller {

//Liste tous les tournois
// public function ListeRencontres(Request $request)
// {
// $rencontre = Rencontre::select('equipe1','equipe2','daterenc','cote_equipe1','cote_equipe2')->get();
// return response()->json($rencontre);
// }

public function ListeRencontres(Request $request)
{
    $rencontres = Rencontre::select('equipe1','equipe2','daterenc','cote_equipe1','cote_equipe2')->get();
    
    $tableauRencontres = array();
    
    foreach ($rencontres as $rencontre) {
        $tableauRencontres[] = array(
            'equipe1' => $rencontre->equipe1,
            'equipe2' => $rencontre->equipe2,
            'daterenc' => $rencontre->daterenc,
            'cote_equipe1' => $rencontre->cote_equipe1,
            'cote_equipe2' => $rencontre->cote_equipe2,
        );
    };

    return response()->json(["tableauRencontre"=>array_values($tableauRencontres)]);
}

public function AjouterRencontre(Request $request) {

    // $validator = Validator::make($request->all(),[        
    //     'jeux' => 'required|int',
    //     'equipe1' => 'required|int',
    //     'equipe2' => 'required|int',
    //     'daterenc' =>'required|date',
    //     'cote_equipe1' => 'required|int',
    //     'cote_equipe2' => 'required|int',
    //     'idtournois' => 'required|int',
    //      ]);

         if ($validator->fails()) {
            return response()->json(["status" => 0, "message" => $validator->errors()],400);
            }

    $rencontre = new Rencontre;

    $rencontre->jeux = $request->jeux;
    $rencontre->equipe1 = $request->equipe1;
    $rencontre->equipe2 = $request->equipe2;
    $rencontre->daterenc = $request->daterenc;
    $rencontre->cote_equipe1 = $request->cote_equipe1;
    $rencontre->cote_equipe2 = $request->cote_equipe2;

    $ok = $rencontre->save();
        if ($ok) {
    return response()->json(["status" => 1, "message" => "LA rencontre a été ajoutée"],201);
        } else {
        return response()->json(["status" => 0, "message" => "pb lors de
        l'ajout"],400);
        }

}

public function ModifierRencontre(Request $request){
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
            return $validator->errors();
            }
    $rencontre = Rencontre::find($request->idrencontre);

    if ($rencontre) {
        $rencontre->jeux = $request->jeux;
        $rencontre->equipe1 = $request->equipe1;
        $rencontre->equipe2 = $request->equipe2;
        $rencontre->daterenc = $request->daterenc;
        $rencontre->cote_equipe1 = $request->cote_equipe1;
        $rencontre->cote_equipe2 = $request->cote_equipe2;
        $rencontre->idtournois = $request->idtournois;
        $rencontre->equipe_gagnante = $request->equipe_gagnante;

        $ok = $rencontre->save();
        if ($ok) {
            return response()->json(["status" => 1, "message" => "rencontre modifié"], 201);
        } else {
            return response()->json(["status" => 0, "message" => "pb lors de
            la modification"], 400);
        }
    } else {

        return response()->json(["status" => 0, "message" => "cette rencontre n'existe pas"], 400);
    }
}


}
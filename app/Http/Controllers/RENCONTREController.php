<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\EQUIPE;
use Illuminate\Http\Request;
use App\Models\RENCONTRE;
use Validator;
use Illuminate\Support\Facades\Log;
class RENCONTREController extends Controller {

//Liste des rencontres
// public function ListeRencontres(Request $request)
// {
// $rencontre = Rencontre::select('idrencontre','equipe1','equipe2','daterenc','cote_equipe1','cote_equipe2')->get();
// return response()->json($rencontre);
// }

public function ListeRencontres(Request $request)
{
    $rencontres = Rencontre::select('idrencontre','equipe1','equipe2','daterenc','cote_equipe1','cote_equipe2', 'jeux')->get();
    
    $tableauRencontres = array();
    
    foreach ($rencontres as $rencontre) {
        $tableauRencontres[] = array(
            'idrencontre' => $rencontre->idrencontre,
            'equipe1' => $rencontre->equipe1,
            'equipe2' => $rencontre->equipe2,
            'daterenc' => $rencontre->daterenc,
            'cote_equipe1' => $rencontre->cote_equipe1,
            'cote_equipe2' => $rencontre->cote_equipe2,
            'jeux' => $rencontre->jeux
        );
    }

    return response()->json($tableauRencontres);
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

        //  if ($validator->fails()) {
        //     return response()->json(["status" => 0, "message" => $validator->errors()],400);
        //     }

        $lastRencontre = DB::table('RENCONTRE')->latest('idrencontre')->first();

        // vérifier si l'enregistrement existe
        if ($lastRencontre) {
          // si oui, ajouter 1 à l'identifiant de la rencontre
          $newIdRencontre = $lastRencontre->idrencontre + 1;
        } else {
          // si non, commencer à 1
          $newIdRencontre = 1;
        }
        
        // créer un nouvel enregistrement de la rencontre avec l'identifiant auto-incrémenté
    $rencontre = new RENCONTRE;
    $rencontre->idrencontre = $newIdRencontre;
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

public function AfficherRechRenc(Request $request) {

$jeux = $request->jeux;
$rencontre = Rencontre::select('equipe1','equipe2','daterenc','cote_equipe1','cote_equipe2', 'jeux')
->where('jeux', "like", '%'.$jeux.'%')
->get();
return response()->json($rencontre);


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

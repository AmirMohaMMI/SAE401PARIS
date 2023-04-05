<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PARIER;
use Validator;

class PARIERController extends Controller{

    public function AjoutePari(Request $request) {

        $validator = Validator::make($request->all(),[        
            'Mise' => ['required','numeric'],
             ]);
    
             if ($validator->fails()) {
                return response()->json(["status" => 0, "message" => $validator->errors()],400);
                }
    
        $pari = new PARIER;
        
        $pari->Mise = $request->Mise;
        $pari->idequipe = $request->idequipe;        
        $pari->idrencontre = $request->idrencontre;
        $pari->iduti = $request->iduti;
        $pari->idtournois = $request->idtournois;
        $ok = $pari->save();
            if ($ok) {
        return response()->json(["status" => 1, "message" => "Votre pari a bien été enregistré"],201);
            } else {
            return response()->json(["status" => 0, "message" => "pb lors du
            pari"],400);
            }
                
    
    
    }
}
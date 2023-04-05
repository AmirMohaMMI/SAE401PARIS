<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TOURNOIS;

class TOURNOISController extends Controller{

    public function list(Request $request)
    {
     $tournois = TOURNOIS::select("idtournois", "jeux", "equipe")->get();          
    return response()->json($tournois);
    }

}
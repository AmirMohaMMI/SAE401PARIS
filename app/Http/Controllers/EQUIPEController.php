<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EQUIPE;

class EQUIPEController extends Controller{

    public function list(Request $request)
    {
     $equipes = EQUIPE::select("logo", "nom")->get();          
    return response()->json($equipes);
    }

}
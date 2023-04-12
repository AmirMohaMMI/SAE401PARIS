<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\UTILISATEUR;
use Validator;

class UTILISATEURController extends Controller{

    public function list(Request $request)
    {
     $uti = UTILISATEUR::select("iduti","pseudo", "email", "nom", "prenom", "mdp", "datecrea", 'pdp', 'description')->get();          
    return response()->json($uti);
    }

    public function ajoututi(Request $request) {
        $uti = new UTILISATEUR;
        $uti->pseudo = $request->pseudo;
        $uti->email = $request->email;
        $uti->nom = $request->nom;
        $uti->prenom = $request->prenom;
        $uti->password = $request->password;
        $uti->datecrea = $request->datecrea;
        $uti->pdp = $request->pdp;
        $uti->description = $request->description;
    
        $validator = Validator::make($request->all(), [
            'nom' => ['required','alpha'],
            'email' =>['required','email'],
            'prenom' =>['required','alpha'],
            'password' =>['required','alpha_dash'],

            ]);
            if ($validator->fails()) {
                return $validator->errors();
                }
                
        $ok = $uti->save();
        if ($ok) {
            return response()->json(["status" => 1, "message" => "uti ajouté"], 201);
        } else {
            return response()->json(["status" => 0, "message" => "pb lors de
       l'ajout"], 400);
        }
    }




    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Si les identifiants sont corrects, on crée une session pour l'utilisateur authentifié
            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;
    
            return response()->json([
                'status' => 'success',
                // 'token' => $token
            ]);
        } else {
            // Si les identifiants sont incorrects, on renvoie un message d'erreur
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password'
            ], 401);
        }
    }

    public function inscription(Request $request) {

    }



}


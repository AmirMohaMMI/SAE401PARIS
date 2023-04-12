<?php

namespace App\Http\Controllers;

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
        $uti->mdp = $request->mdp;
        $uti->datecrea = $request->datecrea;
        $uti->pdp = $request->pdp;
        $uti->description = $request->description;
    
        $validator = Validator::make($request->all(), [
            'nom' => ['required','alpha'],
            'email' =>['required','email'],
            'prenom' =>['required','alpha'],
            'mdp' =>['required','alpha_dash'],

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
    // Vérifier que l'utilisateur a fourni un email et un mot de passe
    $validatedData = $request->validate([
        'email' => 'required|email',
        'mdp' => 'required',
    ]);

    // Trouver l'utilisateur dans la base de données en utilisant l'email
    $user = User::where('email', $validatedData['email'])->first();

    // Vérifier que l'utilisateur existe et que le mot de passe fourni correspond au mot de passe stocké dans la base de données
    if ($user && Hash::check($validatedData['mdp'], $user->mdp)) {
        // Authentifier l'utilisateur
        Auth::login($user);
        // Rediriger l'utilisateur vers la page d'accueil

    }
}


}
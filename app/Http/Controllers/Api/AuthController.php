<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\partenaire; // Replace with your Partenaire model
use App\Models\beneficier;

class AuthController extends Controller
{ 






    //login
    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
    
        $user = User::where('email', $fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'success' => false,
                'message' => 'Invalid login '
            ], 401);
        }
    
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'success' => true,
            'user' => $user,
            'token' => $token,
            'message' => 'Login successful'
        ];
        return response($response, 201);
    }
       
    
//logout
     public function logout(Request $request)
     {
         Auth::logout();
         return response()->json(['message' => 'Successfully logged out']);
     }




     
//isLoggedIn
public function isLoggedIn(Request $request)
{
    if ($request->user()) {
        return response()->json(['status' => true]);
    } else {
        return response()->json(['status' => false]);
    }
}




//register





public function signupPartenaire(Request $request)
{
    // Validation des données
    $validatedData = $request->validate([
        'siret' => 'required',
        'raison_sociale' => 'required',
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'required|email',
        'password' => 'required',
    ]); 

    // Créer un nouvel utilisateur Partenaire
    $user = new User();
    $user->nom = $request->input('nom');
    $user->prenom = $request->input('prenom');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->role = $request->input('role');
   
    if($user->save()){
        $partenaire = new partenaire();
        $partenaire->user_id = $user->id;
        $partenaire->siret = $request->input('siret');
        $partenaire->raison_sociale = $request->input('raison_sociale');
        $partenaire->save();

        // Retourner la réponse de succès
        return response()->json([
            'message' => 'Partenaire inscrit avec succès',
            'partenaire' => $partenaire,
        ]);
    }else{
        // Retourner la réponse de succès
        return response()->json([
            'error' => 'Partenaire n\'est pas inscrie',
        ]);
    }   
}

public function signupBeneficier(Request $request)
{
    // Validation des données
    $validatedData = $request->validate([
        'code_postal' => 'required',
        'ville' => 'required',
        'date_naissance' => 'required',
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'required|email',
        'password' => 'required',
    ]); 

    // Créer un nouvel utilisateur Partenaire
    $user = new User();
    $user->nom = $request->input('nom');
    $user->prenom = $request->input('prenom');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->role = $request->input('role');
   
    if($user->save()){
        $beneficier = new beneficier();
        $beneficier->user_id = $user->id;
        // $partenaire->numero_de_carte = $request->input('numero_de_carte');
        // $partenaire->code_pin = $request->input('code_pin');
        // $partenaire->solde_dispo = $request->input('solde_dispo');
        $beneficier->code_postal = $request->input('code_postal');
        $beneficier->ville = $request->input('ville');
        $beneficier->date_naissance = $request->input('date_naissance');

        $beneficier->save();

        // Retourner la réponse de succès
        return response()->json([
            'message' => 'Beneficier inscrit avec succès',
            'beneficier' => $beneficier,
            'user' => $user
        ]);
    }else{
        // Retourner la réponse de succès
        return response()->json([
            'error' => 'Beneficier n\'est pas inscrie',
        ]);
    }   
}

}

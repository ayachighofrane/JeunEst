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
use App\Models\transaction;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{ 






    //login
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
    
        // Check if the validation fails
        if ($validator->fails()) {
            return response([
                'success' => false,
                'message' => 'Format email invalide'
            ], 400);
        }
    
        $user = User::where('email', $request->input('email'))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response([
                'success' => false,
                'message' => 'Email ou mot de passe incorrect'
            ], 401);
        }
    
        $token = $user->createToken('myapptoken')->plainTextToken;
        if ($user->role=='partenaire'){

            $partenaire=User::where('users.id',$user->id)->join('partenaires','partenaires.user_id','=', 'users.id')->first();
         
            $response = [
                'success' => true,
                'user' => $user,
               'partenaire'=>$partenaire,
                'token' => $token,
                'message' => 'Connexion réussie'
            ];
            return response($response, 201);
        
        }
        if ($user->role=='beneficier'){

            $benificier = User::where('users.id', $user->id)->join('beneficiers','beneficiers.user_id', '=', 'users.id')->first();
        
           

                $response = [
                    'success' => true,
                    'user' => $user,
                    'token' => $token,
                    'benificier'=>$benificier,
                    'message' => 'Connexion réussie'
                ];
                return response($response, 201);
           
          
        }
        $response = [
            'success' => true,
            'user' => $user,
            'token' => $token,
            'message' => 'Connexion réussie'
        ];
        return response($response, 201);
    }
    
    
       
    
//logout
     public function logout(Request $request)
     {
         Auth::logout();
         return response()->json(['message' => 'Déconnexion réussie']);
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

    $user = new User();
    $user->nom = $request->input('nom');
    $user->prenom = $request->input('prenom');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->role = $request->input('role');
    $user->save();
    if($user){
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
        'image'=> 'required',
    ]); 

    $user = new User();
    $user->nom = $request->input('nom');
    $user->prenom = $request->input('prenom');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->role = $request->input('role');
    $user->save();

    if($user){
        $beneficier = new beneficier();
        $beneficier->user_id = $user->id;
        // $partenaire->numero_de_carte = $request->input('numero_de_carte');
        // $partenaire->code_pin = $request->input('code_pin');
        // $partenaire->solde_dispo = $request->input('solde_dispo');
        $beneficier->code_postal = $request->input('code_postal');
        $beneficier->ville = $request->input('ville');
        $beneficier->date_naissance = $request->input('date_naissance');
        $beneficier->image=$request->input('image');
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









public function getCart(Request $request)
    {
        dd($request->user_id);
        // Assurez-vous que l'utilisateur est authentifié
        if (!$request->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Récupérez le bénéficiaire associé à l'utilisateur
        $beneficier = beneficier::where('user_id', $request->user()->id)->first();

        // Vérifiez si le bénéficiaire existe
        if (!$beneficier) {
            return response()->json(['error' => 'Beneficiary not found'], 404);
        }

        // Retournez les données du bénéficiaire
        return response()->json([
            'nom' => $beneficier->nom,
            'prenom' => $beneficier->prenom,
            'numero_de_carte' => $beneficier->numero_de_carte,
            'date_naissance' => $beneficier->date_naissance,
            'ville' => $beneficier->ville,
            'email' => $beneficier->email,

        ]);
    }



    public function getTransaction($id){
       
        $transactions = DB::table('transactions')
        ->join('beneficiers', 'transactions.beneficier_id', '=', 'beneficiers.id')
        ->join('partenaires', 'transactions.partenaire_id', '=', 'partenaires.id')
        ->join('users as beneficiary_users', 'beneficiers.user_id', '=', 'beneficiary_users.id')
        ->join('users as partner_users', 'partenaires.user_id', '=', 'partner_users.id')
        ->select('transactions.*', 'beneficiary_users.nom as beneficiary_name', 'partner_users.nom as partner_name')
        ->get();

    return response()->json($transactions);


    }











}

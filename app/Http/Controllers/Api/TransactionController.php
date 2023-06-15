<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\transaction;
use App\Models\beneficier;
use App\Models\User;
use Carbon\Carbon;

class TransactionController extends Controller
{
    //

    public function searchBeneficier(Request $request){
        
        $numero_carte = $request->numero_de_carte;
        $code_pin = $request->code_pin;
        if($numero_carte==null ||$code_pin==null){
            return response()->json(['error' => 'remplissez les champs svp!'], 422);
        }
    
        $beneficier = beneficier::where('numero_de_carte', '=', $numero_carte)
                        ->where('code_pin', '=', $code_pin)->join('users','user_id','=','users.id')
                        ->select('users.*','beneficiers.*')->get()
                        ->first();
        
        if($beneficier){
            return response()->json(['beneficier' => $beneficier], 200);
        }else{
            return response()->json(['error' => 'beneficier introuvable '], 422);
        }
    }

    function debiter(Request $request){
    
        
        $beneficierId = $request->beneficier;
        $partenaire_id = $request->partenaire;
       $beneficier = beneficier::where('id', '=', $beneficierId )->first();
       $currentDateTime = Carbon::now();
       $formattedDate = Carbon::now()->format('Y-m-d H:i:s');

       $transaction = new transaction();
       $transaction->partenaire_id = $partenaire_id;
       $transaction->beneficier_id = $beneficierId;
       $transaction->montant_debiter = $request->montantADebiter;
       $transaction->Pm = $request->pm;
       $transaction->date_RMH = $formattedDate;
       $transaction->statut = 'Valider';
       if($transaction->save()){
        $beneficier->solde_dispo = $beneficier->solde_dispo - $transaction->montant_debiter;
        
        $beneficier->save();
       }else{
        $transaction->statut = 'Non Valider';
       }

       if($transaction){
        return response()->json('transaction effectuée avec succes', 200);
        }else{
            return response()->json(['error' => 'transaction non effectuée '], 422);
        }

    }


    

}

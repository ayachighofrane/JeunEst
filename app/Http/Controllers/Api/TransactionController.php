<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\transaction;
use App\Models\beneficier;

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
                        ->where('code_pin', '=', $code_pin)
                        ->first();
        // dd($beneficier);
        if($beneficier){
            return response()->json(['beneficier' => $beneficier], 200);
        }else{
            return response()->json(['error' => 'beneficier introuvable '], 422);
        }
    }
    function debiter(Request $request){

        dd($request);
    }

 
}

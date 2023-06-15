<?php

namespace App\Http\Controllers;



use App\Models\User;
use App\Models\beneficier;
use App\Models\partenaire;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardController extends Controller

{
    
    public function generateCard(Request $request, $id)
    {

        $randomCardNumber = mt_rand(10000000000, 99999999999);
        $randomCodePin = mt_rand(1000, 9999);
        $defaultSoldeDispo = 200;
        $beneficier = Beneficier::where('user_id','=',$id)->first();
        if ($beneficier) {
            $beneficier->numero_de_carte = $randomCardNumber;
            $beneficier->code_pin = $randomCodePin;
            $beneficier->solde_dispo = $defaultSoldeDispo;
            $beneficier->save();
        
           
            return redirect()->back()->with('success', 'Détails de la carte générés avec succès.');
        } else {
            return redirect()->back()->with('error', 'Bénéficiaire introuvable.');
        }
        
    }
    




    public function delete($id)
    {
   
        $beneficier = Beneficier::where('user_id','=',$id)->first();
        $user = User::where('id','=',$id)->first();

        if ($beneficier) {
            $beneficier->delete();
            $user ->delete();
            return redirect()->back()->with('success', 'Bénéficiaire supprimé avec succès.');
        } else {
            return redirect()->back()->with('error', 'Bénéficiaire introuvable.');
        }
    }



    
    public function deletepartenaire($id)
    {
   
        $partenaire = partenaire::where('user_id','=',$id)->first();
        $user = User::where('id','=',$id)->first();

        if ($partenaire) {
            $partenaire->delete();
            $user ->delete();
            return redirect()->back()->with('success', 'Partenaire supprimé avec succès.');
        } else {
            return redirect()->back()->with('error', 'Partenaire introuvable.');
        }
    }
    



  




    

}
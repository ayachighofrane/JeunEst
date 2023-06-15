<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\beneficier;
use App\Models\partenaire;
use App\Models\transaction;
class AuthController extends Controller



{
 function benificiers(){
   $beneficiers= User::join('beneficiers','beneficiers.user_id','users.id')
   ->select('beneficiers.*','users.*')
   ->get();
    //return view
    return view('benificiers', ['beneficiers' => $beneficiers]);

 }








 function partenaires()
 {
     $partenaires = User::join('partenaires', 'partenaires.user_id', 'users.id')
         ->select('partenaires.*', 'users.*')
         ->get();
     
     return view('partenaires', ['partenaires' => $partenaires]);
 }
  function transactions(){
    // $transactions= transaction::
  }

  
}

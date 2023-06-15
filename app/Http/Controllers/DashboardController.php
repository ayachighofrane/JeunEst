<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\beneficier;
use App\Models\partenaire;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $transactions=transaction::all()
        // ->join('users')
        $transactions = DB::table('transactions')
        ->join('beneficiers', 'transactions.beneficier_id', '=', 'beneficiers.id')
        ->join('partenaires', 'transactions.partenaire_id', '=', 'partenaires.id')
        ->join('users as beneficiary_users', 'beneficiers.user_id', '=', 'beneficiary_users.id')
        ->join('users as partner_users', 'partenaires.user_id', '=', 'partner_users.id')
        ->select('transactions.*', 'beneficiary_users.nom as beneficiary_name', 'partner_users.nom as partner_name')
        ->get();
        

    return view('dashboard', compact('transactions'));
        // return view('dashboard');
    }
}

<?php
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::post('login', [AuthController::class, 'login']);


Route::post('logout', [AuthController::class, 'logout']);

Route::get('isLoggedIn',[AuthController::class, 'isLoggedIn'])->name('isLoggedIn');


Route::post('search/beneficier', [TransactionController::class, 'searchBeneficier']);


//Route::post('signup', [AuthController::class, 'signup']);


Route::post('signup/partenaire', [AuthController::class, 'signupPartenaire']);
Route::post('signup/beneficier', [AuthController::class, 'signupBeneficier']);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
});


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/partenaires', [App\Http\Controllers\AuthController::class, 'partenaires'])->name('partenaires');
Route::get('/benificiers', [App\Http\Controllers\AuthController::class, 'benificiers'])->name('benificiers');



Route::delete('/delete/{id}', [App\Http\Controllers\CardController::class, 'delete'])->name('delete.beneficier');

Route::post('/generate-card/{id}', [App\Http\Controllers\CardController::class, 'generateCard'])->name('generate.card');


Route::delete('/deletepartenaire/{id}', [App\Http\Controllers\CardController::class, 'deletepartenaire'])->name('delete.partenaire');

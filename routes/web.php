<?php

use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream
=======
use App\Http\Controllers\LogementController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\FactureController;

>>>>>>> Stashed changes

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

<<<<<<< Updated upstream
=======

Route::resource('source', SourceController::class);
Route::resource('facture', FactureController::class);



Route::resource('Logement',LogementController::class);
>>>>>>> Stashed changes
Route::get('/', function () {
    return view('welcome');
});

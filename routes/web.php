<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogementController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ConseilEController;

Route::resource('fournisseurs', FournisseurController::class);
Route::resource('conseils', ConseilEController::class);

Route::resource('Logement',LogementController::class);
Route::get('/', function () {
    return view('welcome');
});

<?php

use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream
=======
use App\Http\Controllers\LogementController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\ElectroController;

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

Route::resource('feedback', FeedbackController::class);
Route::get('/Feedbacks/All', [FeedbackController::class, 'index'])->name('feedbacks.all');
Route::get('feedback/{feedback}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
Route::resource('transports', TransportController::class);
Route::get('/transport/create', [TransportController::class, 'create'])->name('transports.createTransport');
Route::get('transports/{id}/edit', [TransportController::class, 'edit'])->name('transports.editTransport');
Route::put('transports/{id}', [TransportController::class, 'update'])->name('transports.update');

Route::resource('Electros', ElectroController::class);
// Route pour afficher le formulaire d'édition
Route::get('electros/{id_electro}/edit', [ElectroController::class, 'edit'])->name('electros.editElectro');
Route::put('electros/{id_electro}', [ElectroController::class, 'update'])->name('electros.update');
// Dans routes/web.php
Route::get('/logement', [LogementController::class, 'index'])->name('Logement.indexLogement');
Route::get('/electros/create', [ElectroController::class, 'create'])->name('electros.create');
>>>>>>> Stashed changes

Route::get('/', function () {
    return view('welcome');
});

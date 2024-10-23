<?php

use App\Http\Controllers\CarbonFootprintController;
use App\Http\Controllers\EnergyConsumptionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\LogementController;
use App\Http\Controllers\ElectroController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ConseilEController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TransportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('Electros', ElectroController::class);
// Route pour afficher le formulaire d'édition
Route::get('electros/{id_electro}/edit', [ElectroController::class, 'edit'])->name('electros.editElectro');
Route::put('electros/{id_electro}', [ElectroController::class, 'update'])->name('electros.update');
// Dans routes/web.php
Route::get('/logement', [LogementController::class, 'index'])->name('Logement.indexLogement');
Route::get('/electros/create', [ElectroController::class, 'create'])->name('electros.create');
Route::resource('feedback', FeedbackController::class);
Route::get('/Feedbacks/All', [FeedbackController::class, 'index'])->name('feedbacks.all');
Route::get('feedback/{feedback}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
Route::resource('transports', TransportController::class);
Route::get('/transport/create', [TransportController::class, 'create'])->name('transports.createTransport');
Route::get('transports/{id}/edit', [TransportController::class, 'edit'])->name('transports.editTransport');
Route::put('transports/{id}', [TransportController::class, 'update'])->name('transports.update');

Route::resource('source', SourceController::class);
Route::resource('facture', FactureController::class);
Route::resource('fournisseurs', FournisseurController::class);
Route::resource('conseils', ConseilEController::class);
Route::get('electros', [ElectroController::class, 'index'])->name('electros.indexElectro');

Route::resource('Logement', LogementController::class);
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/energyconso', EnergyConsumptionController::class);
    Route::resource('/carbonfootprint', CarbonFootprintController::class);
    route::get('/home', [App\Http\Controllers\frontofficeController::class, 'index'])->name('home');
});

require __DIR__ . '/auth.php';

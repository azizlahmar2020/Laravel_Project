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

// Route pour l'affichage du formulaire de connexion
Route::get('/', function () {
    return view('auth.login');
});

// Route pour le tableau de bord (accessible après login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes accessibles uniquement aux utilisateurs authentifiés
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('Electros', ElectroController::class);
    Route::get('electros/{id_electro}/edit', [ElectroController::class, 'edit'])->name('electros.editElectro');
    Route::put('electros/{id_electro}', [ElectroController::class, 'update'])->name('electros.update');
    Route::get('electros', [ElectroController::class, 'index'])->name('electros.indexElectro');
    Route::get('/electros/create', [ElectroController::class, 'create'])->name('electros.create');
    Route::get('/electros/statistics', [ElectroController::class, 'statistics'])->name('electros.statistics');

    Route::get('/logement', [LogementController::class, 'index'])->name('Logement.indexLogement');
    Route::get('/logements/search', [LogementController::class, 'search'])->name('Logement.search');

    Route::resource('feedback', FeedbackController::class);
    Route::get('/Feedbacks/All', [FeedbackController::class, 'index'])->name('feedbacks.all');
    Route::get('feedback/{feedback}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
    Route::get('/feedstat', [FeedbackController::class, 'statistiques'])->name('feedback.statistiques');

    Route::resource('transports', TransportController::class);
    Route::get('/transport/create', [TransportController::class, 'create'])->name('transports.createTransport');
    Route::get('transports/{id}/edit', [TransportController::class, 'edit'])->name('transports.editTransport');
    Route::put('transports/{id}', [TransportController::class, 'update'])->name('transports.update');
    Route::get('transports/{id}', [TransportController::class, 'show'])->name('transports.show');
    Route::get('/statistics', [TransportController::class, 'statistics'])->name('transports.statistics');

    Route::resource('fournisseurs', FournisseurController::class);
    Route::get('/fournisseurs/{id}/conseils', [ConseilEController::class, 'showConseils'])->name('conseils.fournisseur');

    Route::resource('source', SourceController::class);
    Route::resource('facture', FactureController::class);
    Route::post('/facture/{id}/add-source', [FactureController::class, 'addSource'])->name('facture.addSource');
    Route::post('/facture/{id}/calculate-source', [FactureController::class, 'calculateSource']);
    Route::get('/factures/{id}', [FactureController::class, 'show'])->name('facture.showFacture');
    Route::get('facture/exportPdf/{id}', [FactureController::class, 'exportPdf'])->name('facture.exportPdf');

    Route::resource('conseils', ConseilEController::class);

    // Routes pour EnergyConsumption et CarbonFootprint
    Route::resource('/energyconso', EnergyConsumptionController::class);
    Route::resource('/carbonfootprint', CarbonFootprintController::class);

    // Autres routes nécessitant une authentification
    Route::get('/home', [App\Http\Controllers\frontofficeController::class, 'index'])->name('home');
});

require __DIR__ . '/auth.php';

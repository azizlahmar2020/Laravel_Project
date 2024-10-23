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

// Route d'affichage du login (non protégée)
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Groupement des routes protégées par l'authentification
Route::middleware('auth')->group(function () {
    // Routes du dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Routes de gestion du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes de gestion des logements, électroménagers, fournisseurs, etc.
    Route::get('/fournisseurs/{id}/conseils', [ConseilEController::class, 'showConseils'])->name('conseils.fournisseur');
    Route::resource('Electros', ElectroController::class);
    Route::get('electros/{id_electro}/edit', [ElectroController::class, 'edit'])->name('electros.editElectro');
    Route::put('electros/{id_electro}', [ElectroController::class, 'update'])->name('electros.update');
    Route::get('/logement', [LogementController::class, 'index'])->name('Logement.indexLogement');
    Route::get('/electros/create', [ElectroController::class, 'create'])->name('electros.create');
    Route::resource('feedback', FeedbackController::class);
    Route::get('/Feedbacks/All', [FeedbackController::class, 'index'])->name('feedbacks.all');
    Route::get('feedback/{feedback}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
    Route::resource('transports', TransportController::class);
    Route::get('/transport/create', [TransportController::class, 'create'])->name('transports.createTransport');
    Route::get('transports/{id}/edit', [TransportController::class, 'edit'])->name('transports.editTransport');
    Route::put('transports/{id}', [TransportController::class, 'update'])->name('transports.update');
    Route::get('/feedstat', [FeedbackController::class, 'statistiques'])->name('feedback.statistiques');
    Route::resource('source', SourceController::class);
    Route::resource('facture', FactureController::class);
    Route::resource('fournisseurs', FournisseurController::class);
    Route::resource('conseils', ConseilEController::class);
    Route::get('electros', [ElectroController::class, 'index'])->name('electros.indexElectro');
    Route::get('/logements/search', [LogementController::class, 'search'])->name('Logement.search');
    Route::get('/electros/statistics', [ElectroController::class, 'statistics'])->name('electros.statistics');
    Route::get('/export-pdf-Electro', 'StatController@exportPDF');
    Route::get('transports/{id}', [TransportController::class, 'show'])->name('transports.show');
    Route::get('/statistics', [TransportController::class, 'statistics'])->name('transports.statistics');
    Route::post('/facture/{id}/add-source', [FactureController::class, 'addSource'])->name('facture.addSource');
    Route::post('/facture/{id}/calculate-source', [FactureController::class, 'calculateSource']);
    Route::get('/factures/{id}', [FactureController::class, 'show'])->name('facture.showFacture');
    Route::get('facture/exportPdf/{id}', [FactureController::class, 'exportPdf'])->name('facture.exportPdf');
    Route::resource('Logement', LogementController::class);

    // Autres routes
    Route::resource('/energyconso', EnergyConsumptionController::class);
    Route::resource('/carbonfootprint', CarbonFootprintController::class);

    // Route pour la page d'accueil après login
    Route::get('/home', [App\Http\Controllers\frontofficeController::class, 'index'])->name('home');
});

// Routes d'authentification
require __DIR__ . '/auth.php';

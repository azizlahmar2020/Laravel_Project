<?php

<<<<<<< Updated upstream
=======
use App\Http\Controllers\CarbonFootprintController;
use App\Http\Controllers\EnergyConsumptionController;
use App\Http\Controllers\ProfileController;
>>>>>>> Stashed changes
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< Updated upstream
=======

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/energyconso', EnergyConsumptionController::class);
Route::resource('/carbonfootprint', CarbonFootprintController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [App\Http\Controllers\frontofficeController::class, 'index'])->name('home');


});

require __DIR__ . '/auth.php';
>>>>>>> Stashed changes

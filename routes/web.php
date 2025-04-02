<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create-plan', function () {
    return view('createPlan');
});



Route::get('/travel/form', [TravelController::class, 'showForm'])->name('travel.form');
Route::post('/travel/generate', [TravelController::class, 'generateTravelPlan'])->name('travel.generate');

Route::get('/trips/{trip}', [TravelController::class, 'show'])->name('trips.show');

// Route for generating travel plan (assuming you already have this)
Route::post('/generate-travel-plan', [TravelController::class, 'generateTravelPlan'])->name('travel.generate');

// Route for showing trip details
Route::get('/trips/{tripId}', [TravelController::class, 'show'])->name('trips.show');

// Optional: Route for looking up trips by reference code
Route::get('/trips/reference/{referenceCode}', [TravelController::class, 'showByReference'])->name('trips.show.reference');

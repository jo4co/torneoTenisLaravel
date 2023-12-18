<?php

use App\Http\Controllers\TournamentController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome')->with('titulo', 'Torneo');
});

Route::get('/tournament/{gen?}/{cant?}', [TournamentController::class, 'makeTournament'])
    ->where([
        'gen' => '[a-zA-Z]+',
        'cant' => '[0-9]+',
    ])
    ->name('tournament.make');

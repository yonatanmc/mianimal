<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnimalController;

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

//rutas para el controlador Animal
Route::get('animal', [AnimalController::class, 'index'])->name('animal.index');
Route::post('animal', [AnimalController::class, 'registrar'])->name('animal.registrar');
Route::get('animal/eliminar/{id}', [AnimalController::class, 'eliminar'])->name('animal.eliminar');
Route::get('animal/editar/{id}', [AnimalController::class, 'editar'])->name('animal.editar');
Route::post('animal/actualizar', [AnimalController::class, 'actualizar'])->name('animal.actualizar');

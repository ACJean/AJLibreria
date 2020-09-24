<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\LibroController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/editorial', [EditorialController::class, 'index']);
Route::get('/editorial/list', [EditorialController::class, 'list']);
Route::post('/editorial/save', [EditorialController::class, 'save']);
Route::post('/editorial/delete', [EditorialController::class, 'delete']);

Route::get('/libro', [LibroController::class, 'index']);
Route::get('/libro/list', [LibroController::class, 'list']);
Route::post('/libro/save', [LibroController::class, 'save']);
Route::post('/libro/venta', [LibroController::class, 'venta']);
Route::post('/libro/delete', [LibroController::class, 'delete']);

Route::get('/autor', [AutorController::class, 'index']);
Route::get('/autor/list', [AutorController::class, 'list']);
Route::get('/autores/{id}', [AutorController::class, 'autores']);
Route::post('/autor/save', [AutorController::class, 'save']);
Route::post('/autor/delete', [AutorController::class, 'delete']);

Route::post('/configuracion/save', [ConfiguracionController::class, 'save']);

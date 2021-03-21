<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;


Route::get('/', [FormController::class, 'index']);
Route::get('/form/{id}', [FormController::class, 'indexPedido']);
Route::post('/form', [FormController::class, 'formSubmit'])->name('form.formsubmit');

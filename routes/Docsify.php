<?php

use App\Http\Controllers\DocumentationController;
use Illuminate\Support\Facades\Route;

// Styles & Scripts..
Route::get('/styles/{style}', [DocumentationController::class, 'css'])->name('styles');
Route::get('/scripts/{script}', [DocumentationController::class, 'js'])->name('scripts');

// Documentation..
Route::get('/', [DocumentationController::class, 'index'])->name('index');
Route::get('/{version}/{page?}', [DocumentationController::class, 'show'])->where('page', '(.*)')->name('show');

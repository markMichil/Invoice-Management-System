<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsAdminOrEmployee;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');



Route::middleware(['auth:sanctum',IsAdminOrEmployee::class ])->group(function () {
    // Admin routes
    Route::get('/invoices', [InvoiceController::class, 'index']);  // List all invoices
    Route::get('/invoices/{id}', [InvoiceController::class, 'show']);  // View specific invoice
});

Route::middleware(['auth:sanctum',IsAdmin::class ])->group(function () {
    Route::post('/invoices', [InvoiceController::class,'store']);  // Create invoice
    Route::put('/invoices/{id}', [InvoiceController::class,'update']);  // Update invoice
    Route::delete('/invoices/{id}', [InvoiceController::class,'destroy']);  // Delete invoice
});


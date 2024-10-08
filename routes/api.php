<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsAdminOrEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');



Route::middleware(['auth:sanctum',IsAdminOrEmployee::class ])->group(function () {
    // Admin routes
    Route::get('/invoices', [InvoiceController::class, 'index']);  // List all invoices
    Route::get('/invoices/{id}', [InvoiceController::class, 'show']);  // View specific invoice
    Route::put('/invoices/{id}', [InvoiceController::class,'update']);  // Update invoice
    Route::put('/invoices/{id}/delivery-status', [InvoiceController::class, 'updateDeliveryStatus']); // Update delivery status

});

Route::middleware(['auth:sanctum',IsAdmin::class ])->group(function () {
    Route::post('/invoices', [InvoiceController::class,'store']);  // Create invoice
    Route::delete('/invoices/{id}', [InvoiceController::class,'destroy']);  // Delete invoice
});


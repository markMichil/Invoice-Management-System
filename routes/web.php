<?php

use App\Http\Controllers\Admin\LogActionController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsAdminOrEmployee;
use Illuminate\Support\Facades\Route;
use App\Mail\InvoiceStatusUpdatedMail;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CustomerController;


Route::get('/send-test-email', function () {
    $invoice = Invoice::find(1); // Get a test invoice
    Mail::to('mark2michil@gmail.com')->send(new InvoiceStatusUpdatedMail($invoice));
    return 'Test email sent!';
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('adminLogin');


Route::middleware(['auth:sanctum',IsAdminOrEmployee::class ])->group(function () {

    Route::get('/', [HomeController::class,'index'])->name('adminDashboard');
    Route::get('/logs', [LogActionController::class,'index'])->name('logs');


    Route::resource('customers',CustomerController::class)->only(['index', 'show']);

    Route::get('/logout', [AuthController::class, 'logout'])->name('adminLogout');
});

Route::middleware(['auth:sanctum',IsAdmin::class ])->group(function () {

});


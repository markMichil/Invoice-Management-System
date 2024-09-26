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
use App\Http\Controllers\Admin\InvoiceController;


Route::get('/send-test-email', function () {
    $invoice = Invoice::find(1); // Get a test invoice
    Mail::to('mark2michil@gmail.com')->send(new InvoiceStatusUpdatedMail($invoice));
    return 'Test email sent!';
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('adminLogin');


Route::middleware(['auth',IsAdmin::class ])->group(function () {
    Route::resource('invoices', InvoiceController::class);

});



Route::middleware(['auth',IsAdminOrEmployee::class ])->group(function () {

    Route::get('/', [HomeController::class,'index'])->name('adminDashboard');
    Route::get('/logs', [LogActionController::class,'index'])->name('logs');
    Route::resource('customers',CustomerController::class)->only(['index', 'show']);

    Route::resource('invoices', InvoiceController::class)->only(['index', 'show','edit','update']);
//    // Admin routes
//    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');  // List all invoices
//    Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoices.show');  // View specific invoice
//    Route::put('/invoices/{id}', [InvoiceController::class,'update']);  // Update invoice
//    Route::put('/invoices/{id}/delivery-status', [InvoiceController::class, 'updateDeliveryStatus']); // Update delivery status



    Route::get('/logout', [AuthController::class, 'logout'])->name('adminLogout');
});



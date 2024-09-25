<?php

use Illuminate\Support\Facades\Route;
use App\Mail\InvoiceStatusUpdatedMail;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AuthController;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/send-test-email', function () {
    $invoice = Invoice::find(1); // Get a test invoice
    Mail::to('mark2michil@gmail.com')->send(new InvoiceStatusUpdatedMail($invoice));
    return 'Test email sent!';
});

Route::get('/', [HomeController::class,'index'])->name('adminDashboard');



Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('adminLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('adminLogout');

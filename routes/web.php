<?php

use Illuminate\Support\Facades\Route;
use App\Mail\InvoiceStatusUpdatedMail;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/send-test-email', function () {
    $invoice = Invoice::find(1); // Get a test invoice
    Mail::to('mark2michil@gmail.com')->send(new InvoiceStatusUpdatedMail($invoice));
    return 'Test email sent!';
});

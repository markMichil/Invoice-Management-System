<?php

namespace App\Traits;
use App\Mail\InvoiceStatusUpdatedMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceStatusUpdated;
trait NotifyCustomerTrait
{
    public function notifyCustomer($invoice)
    {
        // Assuming there's a `customer_email` field in the invoice model
        $customerEmail = $invoice->customer_email;

        Mail::to($customerEmail)->send(new InvoiceStatusUpdatedMail($invoice));
    }
}

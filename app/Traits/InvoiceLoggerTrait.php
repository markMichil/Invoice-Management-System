<?php

namespace App\Traits;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

trait InvoiceLoggerTrait
{
    /**
     * Log the action on an invoice.
     *
     * @param string $action
     * @param \App\Models\Invoice $invoice
     * @return void
     */
    public function logAction($action, $invoice)
    {
        $user = Auth::user(); // The currently authenticated user
        Log::create([
            'action' => $action,
            'invoice_id' => $invoice->id,
            'user_id' => $user->id,
            'user_role' => $user->role, // Assuming the user model has a 'role' field
        ]);
    }
}

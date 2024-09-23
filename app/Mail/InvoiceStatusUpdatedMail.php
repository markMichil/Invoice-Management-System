<?php

namespace App\Mail;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $customerEmail;

    /**
     * Create a new message instance.
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->customerEmail = $this->invoice->customer->email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Status Updated Mail',
            to:$this->customerEmail,
            bcc:'mark2mich.il@gmail.com'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        $data = ['invoice'=>$this->invoice];
        return new Content(
            view: 'invoice_mail',
            with: $data
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

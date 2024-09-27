<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use MailerSend\LaravelDriver\MailerSendTrait;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels, MailerSendTrait;

    /**
     * Create a new message instance.
     */
    public $carName;
    public $rentalStartDate;
    public $rentalEndDate;
    public $customerName;
    public $customerEmail;
    public $customerPhone;
    public $customerAddress;

    public function __construct($carName, $rentalStartDate, $rentalEndDate, $customerName, $customerEmail, $customerPhone, $customerAddress)
    {
        $this->carName = $carName;
        $this->rentalStartDate = $rentalStartDate;
        $this->rentalEndDate = $rentalEndDate;
        $this->customerName = $customerName;
        $this->customerEmail = $customerEmail;
        $this->customerPhone = $customerPhone;
        $this->customerAddress = $customerAddress;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Car Has Been Rented',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.AdminMail',
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

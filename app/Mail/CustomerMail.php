<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use MailerSend\LaravelDriver\MailerSendTrait;

class CustomerMail extends Mailable
{
    use Queueable, SerializesModels, MailerSendTrait;

    /**
     * Create a new message instance.
     */
    public $carName;
    public $rentalStartDate;
    public $rentalEndDate;
    public $totalCost;
    public $customerName;
    public $customerAddress;

    public function __construct($carName, $rentalStartDate, $rentalEndDate, $totalCost, $customerName, $customerAddress)
    {
        $this->carName = $carName;
        $this->rentalStartDate = $rentalStartDate;
        $this->rentalEndDate = $rentalEndDate;
        $this->totalCost = $totalCost;
        $this->customerName = $customerName;
        $this->customerAddress = $customerAddress;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Car Rental Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.CustomerMail',
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

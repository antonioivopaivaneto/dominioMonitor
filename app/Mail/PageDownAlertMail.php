<?php

namespace App\Mail;

use App\Models\Pages;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PageDownAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pagina;

    /**
     * Create a new message instance.
     */
    public function __construct(Pages $pagina)
    {
        $this->pagina = $pagina;
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Page Down Alert Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.page_down_alert',
            with:[
                'url' =>$this->pagina->url,
                'status' => 'Fora do Ar',
                'detalhes' =>$this->pagina->status
            ]
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

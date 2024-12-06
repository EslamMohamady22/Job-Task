<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user , $msg , $link;
    /**
     * Create a new message instance.
     */
    public function __construct($user , $msg , $link)
    {
        $this->user = $user;
        $this->msg = $msg;
        $this->link = $link;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Task Notification Mail',
        );
    }

    public function build()
    {
        // dd($this->message);
        return $this->subject('Task Notification Mail')
                    ->view('emails.TaskMail')
                    ->with([
                        'userName' => $this->user->name,
                        'message' => $this->msg ?? 'No message available.',
                        'link' => $this->link,
                    ]);
    }
}

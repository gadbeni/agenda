<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEventMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = '';
    public $topic = '';
    public $description = '';
    public $applicant = '';
    public $place = '';
    public $date = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $topic, $description, $applicant, $place, $date)
    {
        $this->subject = $subject;
        $this->topic = $topic;
        $this->description = $description;
        $this->applicant = $applicant;
        $this->place = $place;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS', 'admin@admin.com'), env('MAIL_FROM_NAME', 'Admin'))
                    ->subject($this->subject)
                    ->view('mail.appointments.new')
                    ->with(['topic' => $this->topic, 'description' => $this->description, 'applicant' => $this->applicant, 'place' => $this->place, 'date' => $this->date]);
    }
}

<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\NewEventMailable;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email = '';
    public $subject = '';
    public $topic = '';
    public $description = '';
    public $applicant = '';
    public $place = '';
    public $date = '';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $subject, $topic, $description, $applicant, $place, $date)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->topic = $topic;
        $this->description = $description;
        $this->applicant = $applicant;
        $this->place = $place;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = new NewEventMailable($this->subject, $this->topic, $this->description, $this->applicant, $this->place, $this->date);
        Mail::to($this->email)->send($mail);
    }
}

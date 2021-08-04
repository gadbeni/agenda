<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Twilio\Rest\Client;

class SendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $number = '';
    public $message = '';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($number, $message)
    {
        $this->number = $number;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Your Account SID and Auth Token from twilio.com/console
        $sid = 'ACbd3e679a9f84200cbb87933f444a1691';
        $token = '120db7de47dff19ee0b5d5bf80c9d607';
        $client = new Client($sid, $token);

        // Use the client to do fun stuff like send text messages!
        $client->messages->create(
            // the number you'd like to send the message to
            '+591'.$this->number, [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+19285175316',
                // the body of the text message you'd like to send
                'body' => $this->message
            ]
        );
    }
}

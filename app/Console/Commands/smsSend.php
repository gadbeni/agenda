<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\SendSMS;

// Models
use App\Models\Appointment;
use App\Models\Notification;

class smsSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar sms de notificación de eventos 20 minitos antes.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $this->info('Ejecutando tarea de envío de sms...');
        $appointments = Appointment::with('assistants')
                            ->whereRaw('NOW() <= start and TIMESTAMPDIFF(MINUTE, NOW(), start) <= 20')->get();
        foreach ($appointments as $appointment) {
            $notification = Notification::where('model_id', $appointment->id)->first();
            if(!$notification){
                foreach ($appointment->assistants as $assistant) {
                    if($assistant->phone){
                        $title = strlen($appointment->topic) > 50 ? substr($appointment->topic, 0, 15).'...' : $appointment->topic;
                        $place = strlen($appointment->place) > 50 ? substr($appointment->place, 0, 15).'...' : $appointment->place;;
                        $time = date('H:i', strtotime($appointment->start));
                        $message = "Tienes $title en $place a las $time";
                        SendSMS::dispatch('67662833', $message);

                        // Store log notification
                        Notification::create([
                            'type' => 'sms',
                            'to' => $assistant->phone,
                            'detail' => $message,
                            'model_id' => $appointment->id
                        ]);

                        // $this->info('['.date('Y-m-d H:i:s').'] SMS enviado al '.$assistant->phone);
                    }
                }
            }
        }
    }
}

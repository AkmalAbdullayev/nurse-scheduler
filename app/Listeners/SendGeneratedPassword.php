<?php

namespace App\Listeners;

use App\Events\NurseCreated;
use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class SendGeneratedPassword
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param NurseCreated $event
     * @return void
     * @throws ConfigurationException
     */
    public function handle(NurseCreated $event): void
    {
        $accountSid = env('TWILIO_SID');
        $accountAuthToken = env('TWILIO_AUTH_TOKEN');
        $accountNumber = env('TWILIO_NUMBER');

        $accountSid = "ACdb11afdf8ce39d623a5b1cab853a4bc7";
        $accountAuthToken = "4438c52d5cddd604f82465dd64116d9c";
        $accountNumber = "+16089252909";

        $url = "https://doescheduling.ssd.uz";

        $client = new Client($accountSid, $accountAuthToken);
        try {
            $message = $client->messages->create($event->nurse->cell_number, [
                'from' => $accountNumber,
                'body' => "$event->generatedPassword is your password for $url. Use it to validate your login."
            ]);
        } catch (TwilioException $exception) {
            echo $exception->getMessage();
        }
    }
}

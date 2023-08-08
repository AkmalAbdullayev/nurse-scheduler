<?php

namespace App\Listeners\Admin;

use App\Events\Admin\CallOutCreated;
use App\helpers\Facades\Twilio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class SendCallOutSms
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
     * @param CallOutCreated $event
     * @return void
     * @throws ConfigurationException
     */
    public function handle(CallOutCreated $event): void
    {
        $url = "https://doescheduling.ssd.uz/login";
        $dates = collect();

        foreach ($event->dates as $date) {
            $dates->push(Carbon::parse($date)->format('d,F'));
        }
        $dates = implode(", ", $dates->values()->all());

        if (is_iterable($event->nurse)) {
            $bindings = $event->nurse->map(fn($nurse) => json_encode([
                'binding_type' => 'sms',
                'address' => $nurse->cell_number
            ]));

            $data = [
                "toBinding" => $bindings->values()->all(),
                'body' => "You have been called out for $dates. Click the link for details. $url"
            ];

            Twilio::bulk($data);
        } else {
            Twilio::send(
                cell_number: $event->nurse->cell_number,
                body: "You have been called out for $dates. Click the link for details. $url"
            );
        }
    }
}

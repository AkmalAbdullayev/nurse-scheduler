<?php

namespace App\Listeners\SchoolNurse;

use App\Events\SchoolNurse\CallOutCreated;
use App\helpers\Facades\Twilio;
use App\Jobs\FullTimeFloatNurse\SendCallOutSms;
use App\Models\Nurse;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class SendCallOutNotification
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
     * @throws TwilioException
     */
    public function handle(CallOutCreated $event): void
    {
        /** @var Nurse|Collection $nurses */
        $nurses = Nurse::query()
            ->active()
            ->with('medical_needs')
            ->whereIn('id', $event->nurse->keys())
            ->get();

        $fullTimeFloatNurses = $nurses->where('role_id', '=', 3);
        $floatNurses = $nurses->where('role_id', '=', 4);

        $url = "https://doescheduling.ssd.uz/login";
        $dates = collect();

        foreach ($event->dates as $date) {
            $dates->push(Carbon::parse($date)->format('d,F'));
        }
        $dates = implode(", ", $dates->values()->all());

        $bindings = $fullTimeFloatNurses->map(fn($nurse) => json_encode([
            'binding_type' => 'sms',
            'address' => $nurse->cell_number
        ]));

        $data = [
            "toBinding" => $bindings->values()->all(),
            'body' => "You have been called out for $dates. Click the link for details. $url"
        ];

        Twilio::bulk($data);

        \App\Jobs\FloatNurse\SendCallOutSms::dispatch($floatNurses, $event->dates, $event->callOuts)
            ->delay(now()->addMinutes(45));
    }
}

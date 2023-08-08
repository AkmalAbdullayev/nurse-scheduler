<?php

namespace App\Jobs\FloatNurse;

use App\Enums\CallOutStatuses;
use App\helpers\Facades\Twilio;
use App\Models\CallOut;
use App\Models\Nurse;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class SendCallOutSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public Collection $nurses, public array $dates, public CallOut|Collection $callOuts)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $sentMessages = collect();

        $this->callOuts->map(callback: function ($callOut) use ($sentMessages) {
            $school = School::query()
                ->with(relations: 'medical_needs')
                ->has('medical_needs')
                ->find($callOut->school_id);

            if (!is_null($school)) {
                if ($callOut->status === CallOutStatuses::PENDING_ACCEPTANCE) {
                    $this->nurses->map(function ($nurse) use ($sentMessages, $callOut, $school) {
                        if (!is_null($nurse->medical_needs)) {
                            if (
                                Carbon::parse($nurse->assigned_date)->format('Y-m-d') != Carbon::parse($callOut->from)->format('Y-m-d')
                                &&
                                $school->medical_needs()->whereIn('medical_need_id', $nurse->medical_needs->pluck('id')->values()->all())->exists()
                            )
                                if ($sentMessages->get($nurse->id) != 'sent') {
                                    /** @var Nurse $nurse */
                                    $url = "https://doescheduling.ssd.uz/login";
                                    $dates = collect();

                                    foreach ($this->dates as $date) {
                                        $dates->push(Carbon::parse($date)->format('d,F'));
                                    }
                                    $dates = implode(", ", $dates->values()->all());

                                    Twilio::send(
                                        cell_number: $nurse->cell_number,
                                        body: "You have been called out for $dates. Click the link for details. $url"
                                    );

                                    $sentMessages->put($nurse->id, 'sent');
                                }
                        }
                    });
                }
            }
        });
    }
}

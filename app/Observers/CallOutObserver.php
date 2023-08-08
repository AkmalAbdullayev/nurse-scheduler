<?php

namespace App\Observers;

use App\helpers\Facades\Twilio;
use App\helpers\Repositories\NurseRepository;
use App\Models\CallOut;
use App\Models\History;
use App\Models\Nurse;
use App\Models\School;

class CallOutObserver
{
    /**
     * Handle the CallOut "created" event.
     *
     * @param CallOut $callOut
     * @return void
     */
    public function created(CallOut $callOut): void
    {
        //
    }

    public function updating(CallOut $callOut): void
    {
        //
    }

    /**
     * Handle the CallOut "updated" event.
     *
     * @param CallOut $callOut
     * @return void
     */
    public function updated(CallOut $callOut): void
    {
        //
    }

    /**
     * Handle the CallOut "deleted" event.
     *
     * @param CallOut $callOut
     * @return void
     */
    public function deleted(CallOut $callOut): void
    {
        //
    }

    /**
     * Handle the CallOut "restored" event.
     *
     * @param CallOut $callOut
     * @return void
     */
    public function restored(CallOut $callOut): void
    {
        //
    }

    /**
     * Handle the CallOut "force deleted" event.
     *
     * @param CallOut $callOut
     * @return void
     */
    public function forceDeleted(CallOut $callOut): void
    {
        //
    }
}

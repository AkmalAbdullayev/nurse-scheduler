<?php

namespace App\Observers;

use App\Models\History;
use App\Models\Nurse;
use App\Models\School;

class SchoolObserver
{
    /**
     * Handle the School "saving" event.
     *
     * @param School $school
     * @return void
     */
    public function saving(School $school): void
    {
        $school->setLogMessage('Record Created');
    }

    /**
     * Handle the School "created" event.
     *
     * @param School $school
     * @return void
     */
    public function created(School $school): void
    {
        //
    }

    /**
     * Handle the School "updating" event.
     *
     * @param School $school
     * @return void
     */
    public function updating(School $school): void
    {
        $school->school_phone = substr_replace($school->school_phone, '+1', 0, 0);

        $school->setLogMessage('Record Updated');
    }

    /**
     * Handle the School "updated" event.
     *
     * @param School $school
     * @return void
     */
    public function updated(School $school): void
    {
        //
    }

    /**
     * Handle the School "deleted" event.
     *
     * @param School $school
     * @return void
     */
    public function deleted(School $school): void
    {
        //
    }

    /**
     * Handle the School "restored" event.
     *
     * @param School $school
     * @return void
     */
    public function restored(School $school): void
    {
        //
    }

    /**
     * Handle the School "force deleted" event.
     *
     * @param School $school
     * @return void
     */
    public function forceDeleted(School $school): void
    {
        //
    }
}

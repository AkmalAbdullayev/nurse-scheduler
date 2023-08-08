<?php

namespace App\Observers;

use App\Models\Nurse;

class NurseObserver
{
    /**
     * Handle the Nurse "saving" event.
     *
     * @param Nurse $nurse
     * @return void
     */
    public function saving(Nurse $nurse): void
    {
        $nurse->setLogMessage('Record Created');
    }

    /**
     * Handle the Nurse "created" event.
     *
     * @param Nurse $nurse
     * @return void
     */
    public function created(Nurse $nurse): void
    {
        //
    }

    /**
     * Handle the Nurse "updating" event.
     *
     * @param Nurse $nurse
     * @return void
     */
    public function updating(Nurse $nurse): void
    {
        $nurse->cell_number = substr_replace($nurse->cell_number, '+1', 0, 0);

        $nurse->setLogMessage('Record Updated');
    }

    /**
     * Handle the Nurse "updated" event.
     *
     * @param Nurse $nurse
     * @return void
     */
    public function updated(Nurse $nurse): void
    {
        //
    }

    /**
     * Handle the Nurse "deleting" event.
     *
     * @param Nurse $nurse
     * @return void
     */
    public function deleting(Nurse $nurse): void
    {
        $nurse->user?->delete();
    }

    /**
     * Handle the Nurse "deleted" event.
     *
     * @param Nurse $nurse
     * @return void
     */
    public function deleted(Nurse $nurse): void
    {
        //
    }

    /**
     * Handle the Nurse "restored" event.
     *
     * @param Nurse $nurse
     * @return void
     */
    public function restored(Nurse $nurse): void
    {
        //
    }

    /**
     * Handle the Nurse "force deleted" event.
     *
     * @param Nurse $nurse
     * @return void
     */
    public function forceDeleted(Nurse $nurse): void
    {
        //
    }
}

<?php

namespace App\Listeners\Admin;

use App\Events\Admin\CallOutChanged;
use App\helpers\Facades\Twilio;
use App\helpers\Repositories\CallOutRepository;

class SendCallOutChangedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private readonly CallOutRepository $callOutRepository,)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param CallOutChanged $event
     * @return void
     */
    public function handle(CallOutChanged $event): void
    {
        $callOut = $this->callOutRepository->find($event->id);

        $url = "https://doescheduling.ssd.uz/login";
        $callOutDate = $callOut->from->format('m.d.Y');

        activity()
            ->useLog('Nurses')
            ->performedOn($callOut->nurse)
            ->withProperties(['attributes' => $callOut->nurse])
            ->log("Call-out for $callOutDate was reassigned");

        Twilio::send(
            cell_number: $callOut->nurse->cell_number,
            body: "You have been called out for $callOutDate. Click the link for details. $url"
        );
    }
}

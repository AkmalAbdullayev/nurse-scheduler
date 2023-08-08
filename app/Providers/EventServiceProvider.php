<?php

namespace App\Providers;

use App\Events\Admin\CallOutChanged;
use App\Events\NurseCreated;
use App\Events\SchoolNurse\CallOutCreated;
use App\Listeners\Admin\SendCallOutChangedNotification;
use App\Listeners\Admin\SendCallOutSms;
use App\Listeners\SchoolNurse\SendCallOutNotification;
use App\Listeners\SendGeneratedPassword;
use App\Models\CallOut;
use App\Models\Nurse;
use App\Models\School;
use App\Observers\CallOutObserver;
use App\Observers\NurseObserver;
use App\Observers\SchoolObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CallOutCreated::class => [
            SendCallOutNotification::class
        ],
        NurseCreated::class => [
            SendGeneratedPassword::class,
        ],
        \App\Events\Admin\CallOutCreated::class => [
            SendCallOutSms::class
        ],
        CallOutChanged::class => [
            SendCallOutChangedNotification::class
        ]
    ];

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Nurse::class => [NurseObserver::class],
        School::class => [SchoolObserver::class],
        CallOut::class => [CallOutObserver::class]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}

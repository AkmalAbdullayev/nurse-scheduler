<?php

namespace App\helpers\Facades;

use Illuminate\Support\Facades\Facade;

class Twilio extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'twilio';
    }
}

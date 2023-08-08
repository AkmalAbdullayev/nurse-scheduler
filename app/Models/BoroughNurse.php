<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BoroughNurse extends Pivot
{
    protected $table = 'borough_nurse';

    public function nurse(): BelongsTo
    {
        return $this->belongsTo(Nurse::class);
    }
}

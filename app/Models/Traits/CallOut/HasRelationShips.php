<?php

namespace App\Models\Traits\CallOut;

use App\Models\Nurse;
use App\Models\School;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasRelationShips
{
    /**
     * @return BelongsTo
     */
    public function nurse(): BelongsTo
    {
        return $this->belongsTo(Nurse::class);
    }

    /**
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}

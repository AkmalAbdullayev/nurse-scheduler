<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class NurseSchool extends Pivot
{
    /**
     * @var string
     */
    protected $table = 'nurse_school';

    /**
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * @return BelongsTo
     */
    public function nurse(): BelongsTo
    {
        return $this->belongsTo(Nurse::class);
    }

    protected static function booted()
    {
        parent::booted();

        static::created(function (NurseSchool $nurseSchool) {
            $nurse = Nurse::query()->find($nurseSchool->nurse_id);
            $school = School::query()->find($nurseSchool->school_id);

            activity()
                ->useLog('Schools')
                ->performedOn($school)
                ->withProperties(['attributes' => $nurse])
                ->log('Nurse was assigned to a school');

            activity()
                ->useLog('Nurses')
                ->performedOn($nurse)
                ->withProperties(['attributes' => $nurse])
                ->log('Your role was changed to a school nurse');
        });
    }
}

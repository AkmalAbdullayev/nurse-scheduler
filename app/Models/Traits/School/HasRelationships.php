<?php

namespace App\Models\Traits\School;

use App\Models\Borough;
use App\Models\CallOut;
use App\Models\History;
use App\Models\MedicalNeed;
use App\Models\Nurse;
use App\Models\NurseSchool;
use App\Models\SchoolPrincipal;
use App\Models\State;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\Models\Activity;

trait HasRelationships
{
    /**
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * @return BelongsTo
     */
    public function borough(): BelongsTo
    {
        return $this->belongsTo(Borough::class);
    }

    /**
     * @return BelongsToMany
     */
    public function nurses(): BelongsToMany
    {
        return $this->belongsToMany(Nurse::class)
            ->using(NurseSchool::class)
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function medical_needs(): BelongsToMany
    {
        return $this->belongsToMany(MedicalNeed::class, 'medical_needs_school')
            ->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function school_principal(): BelongsTo
    {
        return $this->belongsTo(SchoolPrincipal::class, 'principal_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function call_outs(): HasMany
    {
        return $this->hasMany(CallOut::class);
    }

    /**
     * @return MorphMany
     */
    public function history(): MorphMany
    {
        return $this->morphMany(History::class, 'historiable');
    }

    /**
     * @return MorphMany
     */
    public function subject(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}

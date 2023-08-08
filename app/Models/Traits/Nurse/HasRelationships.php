<?php

namespace App\Models\Traits\Nurse;

use App\Models\Borough;
use App\Models\BoroughNurse;
use App\Models\CallOut;
use App\Models\City;
use App\Models\History;
use App\Models\MedicalNeed;
use App\Models\NurseCredential;
use App\Models\School;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

trait HasRelationships
{
    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function desired_boroughs(): BelongsToMany
    {
        return $this->belongsToMany(Borough::class, 'borough_nurse', 'nurse_id', 'borough_id')
            ->using(BoroughNurse::class)
            ->withPivot(['is_primary'])
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function credentials(): BelongsToMany
    {
        return $this->belongsToMany(NurseCredential::class, 'nurse_nurse_credentials')
            ->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return BelongsToMany
     */
    public function schools(): BelongsToMany
    {
        return $this->belongsToMany(School::class);
    }

    /**
     * @return BelongsToMany
     */
    public function medical_needs(): BelongsToMany
    {
        return $this->belongsToMany(MedicalNeed::class, 'nurse_medical_needs')
            ->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function call_outs(): HasMany
    {
        return $this->hasMany(CallOut::class);
    }

    /**
     * @return BelongsTo
     */
    public function borough(): BelongsTo
    {
        return $this->belongsTo(Borough::class);
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

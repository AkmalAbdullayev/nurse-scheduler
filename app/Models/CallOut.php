<?php

namespace App\Models;

use App\Enums\CallOutStatuses;
use App\helpers\Support\CallOutsCollection;
use App\Models\Traits\CallOut\HasRelationShips;
use App\Models\Traits\CallOut\HasScopes;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @class CallOut
 * @property integer $nurse_id
 * @property integer $school_id
 * @property DateTime $from
 * @property DateTime $to
 * @property string $status
 * @property integer $confirmed
 * @property integer $created_by_id
 * @property string $created_by_str
 * @property string $time_of_arrival
 * @property string $created_by_role
 * @property string $special_notes
 * @property Nurse|Collection $nurse
 * @property School|Collection $school
 */
class CallOut extends Model
{
    use HasFactory,
        SoftDeletes,
        HasRelationShips,
        HasScopes;

    protected $fillable = [
        'nurse_id',
        'school_id',
        'from',
        'to',
        'status',
        'confirmed',
        'created_by_id',
        'created_by_str',
        'created_by_role',
        'special_notes'
    ];

    protected $casts = [
        'from' => 'datetime',
        'to' => 'datetime',
        'time_of_arrival' => 'datetime',
        'status' => CallOutStatuses::class,
    ];

    /**
     * @param array $models
     * @return CallOutsCollection
     */
    public function newCollection(array $models = []): CallOutsCollection
    {
        return new CallOutsCollection($models);
    }
}

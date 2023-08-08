<?php

namespace App\Models;

use App\Models\Traits\School\HasRelationships;
use App\Models\Traits\School\HasScopes;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @class School
 * @property string $building_code
 * @property string $district
 * @property string $primary_dbn
 * @property string $school_name
 * @property string $street_address_1
 * @property string $street_address_2
 * @property string $city
 * @property int $state_id
 * @property integer $zip_code
 * @property string $assigned_rn
 * @property string $email
 * @property integer $borough_id
 * @property string $school_phone
 * @property string $google_map
 * @property integer $principal_id
 * @property string $special_notes
 * @property integer $assignment_priority
 * @property integer $is_active
 *
 * @property Collection $nurses
 * @property Collection $medical_needs
 */
class School extends Model
{
    use HasFactory,
        HasRelationships,
        HasScopes,
        SoftDeletes,
        LogsActivity;

    protected $fillable = [
        'building_code',
        'district',
        'primary_dbn',
        'school_name',
        'street_address_1',
        'street_address_2',
        'city',
        'state_id',
        'zip_code',
//        'assigned_rn',
        'email',
        'borough_id',
        'school_phone',
        'google_map',
        'principal_id',
        'special_notes',
        'assignment_priority',
        'is_active',
    ];

    private ?string $logMessage = '';

    public function getMedicalNeeds(): \Illuminate\Support\Collection
    {
        $schoolMedicalNeeds = collect();

        foreach ($this->medical_needs as $medical_need) {
            $schoolMedicalNeeds->push($medical_need);
        }

        return $schoolMedicalNeeds;
    }

    public function setLogMessage(string $message)
    {
        $this->logMessage = $message;
    }

    public function getLogMessage(): ?string
    {
        return $this->logMessage;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function () {
                return $this->getLogMessage();
            })
            ->useLogName('Schools')
            ->dontSubmitEmptyLogs()
            ->logAll();
    }
}

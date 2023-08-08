<?php

namespace App\Models;

use App\Models\Traits\Nurse\HasRelationships;
use App\Models\Traits\Nurse\HasScopes;
use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

/**
 * @class Nurse
 * @property int $id
 * @property string $cell_number
 * @property string $office_phone
 * @property string $first_name
 * @property string $last_name
 * @property string $mi
 * @property string $street_address_1
 * @property string $street_address_2
 * @property string $city
 * @property integer $state_id
 * @property integer $borough_id
 * @property integer $zip_code
 * @property string $email
 * @property string $license_number
 * @property string $special_notes
 * @property integer $role_id
 * @property integer $user_id
 * @property boolean $active_for_assignments
 * @property DateTime $assigned_date
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Collection $credentials
 * @property Collection $desired_boroughs
 * @property Collection $medical_needs
 */
class Nurse extends Model
{
    use HasFactory,
        HasRelationships,
        HasScopes,
        HasRoles,
        SoftDeletes,
        LogsActivity;

    protected $fillable = [
        'cell_number',
        'office_phone',
        'first_name',
        'last_name',
        'mi',
        'street_address_1',
        'street_address_2',
        'city',
        'state_id',
        'zip_code',
        'email',
        'license_number',
        'special_notes',
        'role_id',
        'active_for_assignments'
    ];

    protected $casts = [
        'assigned_date' => 'datetime',
    ];

    protected $appends = ['full_name'];

    private ?string $logMessage = '';

    public function getDesiredBoroughs(): \Illuminate\Support\Collection
    {
        $primaryDesiredBoroughs = collect();
        $desiredBoroughs = collect();

        foreach ($this->desired_boroughs as $desiredBorough) {
            if ($desiredBorough->pivot->is_primary == 1) {
                $primaryDesiredBoroughs->push($desiredBorough->pivot);
            } else {
                $desiredBoroughs->push($desiredBorough->pivot);
            }
        }

        return collect([
            'primaryDesiredBoroughs' => $primaryDesiredBoroughs->sortByDesc('created_at')->values(),
            'desiredBoroughs' => $desiredBoroughs
        ]);
    }

    public function getMedicalSkills(): \Illuminate\Support\Collection
    {
        $medicalNeedsCollection = collect();

        foreach ($this->medical_needs as $medicalNeed) {
            $medicalNeedsCollection->push($medicalNeed->id);
        }

        return $medicalNeedsCollection;
    }

    public function getCredentials(): \Illuminate\Support\Collection
    {
        $nurseCredentials = collect();

        $this->credentials->map(fn($credential) => $nurseCredentials->push($credential))->last();

        return $nurseCredentials;
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->first_name . " " . $this->mi . " " . $this->last_name
        );
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
            ->useLogName('Nurses')
            ->logAll();
    }
}

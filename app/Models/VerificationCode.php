<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @class VerificationCode
 *
 * @property integer $user_id
 * @property string $otp
 * @property DateTime $expire_at
*/

class VerificationCode extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'otp', 'expire_at'];

    protected $casts = [
        'expire_at' => 'datetime'
    ];
}

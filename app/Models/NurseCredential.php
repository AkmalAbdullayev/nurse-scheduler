<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseCredential extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}

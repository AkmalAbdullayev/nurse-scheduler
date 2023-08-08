<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolPrincipal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'cell_number'
    ];
}

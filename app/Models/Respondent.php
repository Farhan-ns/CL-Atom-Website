<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'religion',
        'age',
        'coming_from',
    ];
}

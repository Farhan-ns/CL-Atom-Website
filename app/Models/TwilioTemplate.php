<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwilioTemplate extends Model
{
    protected $fillable = [
        'templates',
        'templates->new_year_sid',
        'templates->birthday_sid',
        'templates->idul_fitri_sid',
        'templates->christmas_sid',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'templates' => 'array',
        ];
    }
}

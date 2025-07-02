<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo_path',
    ];

    public function getLogoAttribute()
    {
        if ($this->logo_path) {
            return asset('storage/' . $this->logo_path);
        }

        $sluggedName = str($this->name)->slug();
        return "https://ui-avatars.com/api/?name=$sluggedName)";
    }
}

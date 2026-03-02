<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Polyclinic extends Model
{
    protected $guarded = ['id'];

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
}
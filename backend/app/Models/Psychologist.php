<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Psychologist extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization',
        'bio',
        'consultation_fee',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function professionals()
    {
        return $this->hasMany(Professional::class, 'clinic_id', 'clinic_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'clinic_id', 'clinic_id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'clinic_id', 'clinic_id');
    }
}

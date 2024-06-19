<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'clinic_id');
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class, 'professional_id', 'professional_id');
    }

    public function plans()
    {
        return $this->hasMany(Plan::class, 'evaluation_id', 'evaluation_id');
    }
}

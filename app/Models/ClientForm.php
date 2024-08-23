<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientForm extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];



    public function evaluation()
    {
        return $this->hasOne(Evaluation::class, 'client_form_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Booking extends Model
{
    //
    use Notifiable;
    protected $guarded=[];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
}

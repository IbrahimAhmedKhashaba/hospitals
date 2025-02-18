<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ray extends Model
{
    //

    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function ray_employee()
    {
        return $this->belongsTo(RayEmployee::class,'ray_employee_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
}

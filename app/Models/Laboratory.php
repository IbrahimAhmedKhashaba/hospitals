<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
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

    public function laboratory_employee()
    {
        return $this->belongsTo(RayEmployee::class,'laboratory_employee_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

}

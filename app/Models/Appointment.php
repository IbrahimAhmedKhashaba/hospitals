<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    //
    use Translatable , HasFactory;
    public $translatedAttributes = ['name'];
    protected $fillable = ['name'];

    public function doctors(){
        return $this->belongsToMany(Doctor::class , 'appointment_doctor');
    }
}

<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Paddle\Billable;

class Patient extends Authenticatable
{
    //

    use Translatable , HasFactory , Notifiable , Billable;

    public $translatedAttributes = ['name' , 'address'];
    public $fillable = [ 'email' , 'phone' , 'password'  , 'gender' , 'date_birth' , 'blood_group' , 'name' , 'address'];

    public function invoice(){
        return $this->hasMany(Invoice::class);
    }

    public function translations()
    {
        return $this->hasMany(PatientTranslation::class, 'patient_id');  // Replace PatientTranslation::class with your actual translation model
    }
}

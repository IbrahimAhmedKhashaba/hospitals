<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Doctor extends Authenticatable
{
    use HasFactory, Notifiable , Translatable;

    public $translatedAttributes = ['name'];
    public $fillable = [ 'email' , 'email_verified_at' , 'password'  , 'section_id' , 'phone' , 'name'];
    // public $timestamps = false;

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function appointments(){
        return $this->belongsToMany(Appointment::class , 'appointment_doctor');
    }

    public function invoices(){
        return $this->hasMany(SingleInvoice::class);
    }


}

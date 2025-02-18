<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    use HasFactory,Translatable;
    protected $translatedAttributes = ['name'];
    protected $fillable = ['name' , 'description', 'status'];

    public function service_group(){
        return $this->belongsToMany(Group::class);
    }

    public function invoices(){
        return $this->hasMany(SingleInvoice::class);
    }
}

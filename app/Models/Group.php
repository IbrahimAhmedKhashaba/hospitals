<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    use Translatable , HasFactory;
    public $translatedAttributes = ['name' , 'notes'];
    protected $fillable = ['total_before_discount' , 'discount_value', 'total_after_discount' , 'tax_rate' , 'tax_value' , 'total_with_tax'];

    public function service_group(){
        return $this->belongsToMany(Service::class , 'group_service')->withPivot('quantity');
    }
}

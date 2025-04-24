<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class LaboratoryEmployee extends Authenticatable
{
    //
    use Notifiable;
    protected $guarded = [];
}

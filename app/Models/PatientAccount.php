<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientAccount extends Model
{
    //
    protected $guarded = [];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function receipt_account(){
        return $this->belongsTo(ReceiptAccount::class);
    }
}

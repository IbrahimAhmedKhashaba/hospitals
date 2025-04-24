<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $Patients = new Patient();
           $Patients->email = 'ibrahim@pa.com';
           $Patients->password = Hash::make('789789789');
           $Patients->date_birth = '2000-3-19';
           $Patients->phone = '01124782711';
           $Patients->gender = 1;
           $Patients->blood_group = 'A+';
           $Patients->save();
           //insert trans
           $Patients->name = 'إبراهيم مريض';
           $Patients->address = 'العجوبية';
           $Patients->save();
    }
}

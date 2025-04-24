<?php

namespace Database\Seeders;

use App\Models\RayEmployee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RayEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ray_employee = new RayEmployee();
            $ray_employee->name = 'إبراهيم موظف';
            $ray_employee->email = 'ibrahim@ray.com';
            $ray_employee->password = Hash::make('789789789');
            $ray_employee->save();
    }
}

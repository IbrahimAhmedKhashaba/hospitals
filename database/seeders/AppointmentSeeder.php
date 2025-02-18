<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('appointments')->delete();
        $appointments = [
            ['name' => 'السبت' ],
            ['name' => 'الأحد' ],
            ['name' => 'الأثنين' ],
            ['name' => 'الثلاثاء' ],
            ['name' => 'الأربعاء' ],
            ['name' => 'الخميس' ],
            ['name' => 'الجمعة' ],
        ];

        foreach($appointments as $appointment){
            Appointment::create($appointment);
        }
    }
}

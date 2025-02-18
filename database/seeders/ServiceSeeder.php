<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $service = new Service();

            $service->price = 200;
            $service->description = 'fkhdsdfhjksfdjhdfhjs';
            $service->status = 1;
            $service->save();

            $service->name = 'كشف اخصائي';
            $service->save();

            $service = new Service();

            $service->price = 300;
            $service->description = 'fkhdsdfhjksfdjhdfhjs';
            $service->status = 1;
            $service->save();

            $service->name = 'كشف استشاري';
            $service->save();
    }
}

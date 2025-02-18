<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->delete();
        DB::table('admins')->insert([
            'name' => 'Ibrahim Khashaba',
            'email' => 'ibrahim@admin.com',
            'password' => Hash::make('789789789'),
        ]);
        DB::table('admins')->insert([
            'name' => 'Nada Khashaba',
            'email' => 'nada@admin.com',
            'password' => Hash::make('789789789'),
        ]);
    }
}

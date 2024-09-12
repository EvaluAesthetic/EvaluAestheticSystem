<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            'user_id' => 2,
            'clinic_id' => 1,
        ]);

        DB::table('clients')->insert([
            'user_id' => 4,
            'clinic_id' => 1,
        ]);

        DB::table('clients')->insert([
            'user_id' => 5,
            'clinic_id' => 1,
        ]);

        DB::table('clients')->insert([
            'user_id' => 6,
            'clinic_id' => 1,
        ]);

        DB::table('clients')->insert([
            'user_id' => 7,
            'clinic_id' => 1,
        ]);
        DB::table('clients')->insert([
            'user_id' => 9,
            'clinic_id' => 2,
        ]);
    }
}

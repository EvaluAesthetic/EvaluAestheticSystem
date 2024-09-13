<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionalsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('professionals')->insert([
            'user_id' => 1,
            'clinic_id' => 1,
        ]);
        DB::table('professionals')->insert([
            'user_id' => 3,
            'clinic_id' => 1,
        ]);

        DB::table('professionals')->insert([
            'user_id' => 9,
            'clinic_id' => 2,
        ]);

        DB::table('professionals')->insert([
            'user_id' => 20,
            'clinic_id' => 2,
        ]);

    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionalsTableSeeder extends Seeder
{
    public function run()
    {
        $clinics = DB::table('clinics')->pluck('id');
        DB::table('professionals')->insert([
            'user_id' => 1,
            'clinic_id' => 1,
        ]);

        foreach (range(2, 10) as $index) {
            DB::table('professionals')->insert([
                'user_id' => $index,
                'clinic_id' => $clinics->random(),
            ]);
        }
    }
}

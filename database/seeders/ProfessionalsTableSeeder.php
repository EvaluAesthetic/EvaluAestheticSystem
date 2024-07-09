<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionalsTableSeeder extends Seeder
{
    public function run()
    {
        $users = DB::table('users')->pluck('id');
        $clinics = DB::table('clinics')->pluck('id');

        foreach (range(1, 10) as $index) {
            DB::table('professionals')->insert([
                'user_id' => $users->random(),
                'clinic_id' => $clinics->random(),
            ]);
        }
    }
}

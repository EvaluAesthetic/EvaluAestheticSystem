<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ClientFormsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = DB::table('users')->pluck('id');
        $clinics = DB::table('clinics')->pluck('id');

        foreach (range(1, 10) as $index) {
            DB::table('client_forms')->insert([
                'user_id' => $users->random(),
                'clinic_id' => $clinics->random(),
                'has_history' => $faker->boolean,
                'history' => $faker->paragraph,
                'disease' => $faker->word,
                'has_disease' => $faker->boolean,
                'has_allergy' => $faker->boolean,
                'allergy' => $faker->word,
                'had_previous_treatments' => $faker->boolean,
                'previous_treatments' => $faker->paragraph,
                'medication' => $faker->word,
                'has_medication' => $faker->boolean,
                'occupation' => $faker->jobTitle,
                'video_path' => $faker->url,
            ]);
        }
    }
}
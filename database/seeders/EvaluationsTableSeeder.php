<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class EvaluationsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $clientForms = DB::table('client_forms')->pluck('id');
        $professionals = DB::table('professionals')->pluck('id');
        $clinics = DB::table('clinics')->pluck('id');

        foreach (range(1, 10) as $index) {
            DB::table('evaluations')->insert([
                'client_form_id' => $clientForms->random(),
                'status' => $faker->randomDigitNotNull,
                'professional_id' => $professionals->random(),
                'approved_at' => $faker->dateTime(),
                'clinic_id' => $clinics->random(),
            ]);
        }
    }
}

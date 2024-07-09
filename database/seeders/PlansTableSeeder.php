<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $evaluations = DB::table('evaluations')->pluck('id');

        foreach (range(1, 10) as $index) {
            DB::table('plans')->insert([
                'evaluation_id' => $evaluations->random(),
                'description' => $faker->paragraph,
                'plan' => $faker->paragraph,
            ]);
        }
    }
}

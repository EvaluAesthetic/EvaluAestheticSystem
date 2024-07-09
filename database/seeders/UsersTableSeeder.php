<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'phone' => '123-456-7890',
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);


        foreach (range(1, 10) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->e164PhoneNumber(),
                'password' => Hash::make('password'), // or $faker->password,
                'email_verified_at' => $faker->dateTime(),
                'approved_at' => $faker->dateTime(),
            ]);
        }
    }
}

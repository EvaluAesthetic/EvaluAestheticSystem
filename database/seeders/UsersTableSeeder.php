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
            'name' => 'Test User Clinic Admin',
            'email' => 'test@test.com',
            'phone' => '123-456-7890',
            'birthday' => '1986-07-28',
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Test User Client',
            'email' => 'test2@test.com',
            'phone' => '123-456-7890',
            'birthday' => '1966-04-22',
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Test User Professional',
            'email' => 'test3@test.com',
            'phone' => '123-456-7890',
            'birthday' => '1996-02-23',
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Test User Client 2',
            'email' => 'test4@test.com',
            'phone' => '123-456-7890',
            'birthday' => '1980-10-15',
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Test User Client 3',
            'email' => 'test5@test.com',
            'phone' => '123-456-7890',
            'birthday' => '1990-12-24',
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Test User Client 4',
            'email' => 'test6@test.com',
            'phone' => '123-456-7890',
            'birthday' => '1977-11-23',
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Test User Client 5',
            'email' => 'test7@test.com',
            'phone' => '123-456-7890',
            'birthday' => '1994-03-25',
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);


        foreach (range(1, 10) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->e164PhoneNumber(),
                'birthday' => $faker->date(),
                'password' => Hash::make('password'), // or $faker->password,
                'email_verified_at' => $faker->dateTime(),
                'approved_at' => $faker->dateTime(),
            ]);
        }
    }
}

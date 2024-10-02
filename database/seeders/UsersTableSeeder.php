<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            'name' => $faker->name . ' Clinic Admin',
            'email' => 'test@test.com',
            'phone' => '61461766',
            'cpr' => Crypt::encryptString('111111-1111'),
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' =>  $faker->name . ' Client',
            'email' => 'test2@test.com',
            'phone' => '61461766',
            'cpr' => Crypt::encryptString('111111-1111'),
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => $faker->name . ' Professional',
            'email' => 'test3@test.com',
            'phone' => '61461766',
            'cpr' => Crypt::encryptString('111111-1111'),
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => $faker->name . ' Client',
            'email' => 'test4@test.com',
            'phone' => '61461766',
            'cpr' => Crypt::encryptString('111111-1111'),
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => $faker->name . ' Client',
            'email' => 'test5@test.com',
            'phone' => '61461766',
            'cpr' => Crypt::encryptString('111111-1111'),
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => $faker->name . ' Client',
            'email' => 'test6@test.com',
            'phone' => '61461766',
            'cpr' => Crypt::encryptString('111111-1111'),
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => $faker->name . ' Client',
            'email' => 'test7@test.com',
            'phone' => '61461766',
            'cpr' => Crypt::encryptString('111111-1111'),
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => $faker->name . ' Admin',
            'email' => 'admin@test.com',
            'phone' => '61461766',
            'cpr' => Crypt::encryptString('000000-0000'),
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => $faker->name . ' Admin Another Clinic',
            'email' => 'clinicAdmin@test.com',
            'phone' => '61461766',
            'cpr' => Crypt::encryptString('111111-1111'),
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);


        $numUsers = 10;

        for ($i = 0; $i < $numUsers; $i++) {

            $birthday = $faker->dateTimeBetween('-50 years', '-18 years');
            $day = str_pad($birthday->format('d'), 2, '0', STR_PAD_LEFT);
            $month = str_pad($birthday->format('m'), 2, '0', STR_PAD_LEFT);
            $year = substr($birthday->format('Y'), -2);


            $lastFourDigits = str_pad($faker->numberBetween(0, 9999), 4, '0', STR_PAD_LEFT);


            $cprNumber = "{$day}{$month}{$year}-{$lastFourDigits}";

            DB::table('users')->insert([
                'name' => $faker->name . ' Clinic Admin',
                'email' => $faker->unique()->safeEmail,
                'phone' => '61461766',
                'cpr' => Crypt::encryptString($cprNumber),
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'approved_at' => now(),
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Test Professional Another Clinic',
            'email' => 'clinicWorker@test.com',
            'phone' => '61461766',
            'cpr' => Crypt::encryptString('222222-2222'),
            'password' => Hash::make('password'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
    }
}

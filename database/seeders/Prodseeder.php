<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Prodseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Indsætter roller
        $this->call(RolesTableSeeder::class);
        //Opretter den første klinik
        DB::table('clinics')->insert([
            'name' => 'Alfa Omega Klinikken',
            'address' => 'Højbro Pl. 21, 1200 København K',
            'phone' => '+4532203203',
            'email' => 'info@alfaomegaklinikken.dk',
        ]);
        $faker = Faker::create();

        //Super Admin til os udviklere
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@test.com',
            'phone' => $faker->e164PhoneNumber(),
            'birthday' => '1986-07-28',
            'password' => Hash::make('SuperAdmin2906'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);

        //Klinik Admin
        DB::table('users')->insert([
            'name' => 'Klinik Admin',
            'email' => 'klinikadmin@test.com',
            'phone' => $faker->e164PhoneNumber(),
            'birthday' => '1981-03-13',
            'password' => Hash::make('KlinikAdminBruger'), // You can change 'password' to your desired password
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => 2,
        ]);
        DB::table('professionals')->insert([
            'user_id' => 2,
            'clinic_id' => 1,
        ]);

        //Klient brugere
        foreach (range(1, 10) as $index) {
            DB::table('users')->insert([
                'name' => 'Klient Bruger' . $index,
                'email' => 'klient' . $index . '@test.com',
                'phone' => $faker->e164PhoneNumber(),
                'birthday' => $faker->date(),
                'password' => Hash::make('Klientbruger'), // or $faker->password,
                'email_verified_at' => now(),
                'approved_at' => now(),
            ]);
            DB::table('role_user')->insert([
                'role_id' => 4,
                'user_id' => 2 + $index,
            ]);
            DB::table('clients')->insert([
                'user_id' => 2 + $index,
                'clinic_id' => 1,
            ]);
        }

        //Arbejder bruger
        foreach (range(1, 5) as $index) {
            DB::table('users')->insert([
                'name' => 'Behandler Bruger' . $index,
                'email' => 'behandler' . $index . '@test.com',
                'phone' => $faker->e164PhoneNumber(),
                'birthday' => $faker->date(),
                'password' => Hash::make('Behandlerbruger'), // or $faker->password,
                'email_verified_at' => now(),
                'approved_at' => now(),
            ]);
            DB::table('role_user')->insert([
                'role_id' => 3,
                'user_id' => 12 + $index,
            ]);
            DB::table('professionals')->insert([
                'user_id' => 12 + $index,
                'clinic_id' => 1,
            ]);
        }
    }
}

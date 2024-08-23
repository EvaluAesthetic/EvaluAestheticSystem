<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('role_user')->insert([
           'role_id' => 2,
           'user_id' => 1,
        ]);
        DB::table('role_user')->insert([
           'role_id' => 4,
           'user_id' => 2,
        ]);
        DB::table('role_user')->insert([
           'role_id' => 3,
           'user_id' => 3,
        ]);
        foreach (range(4, 7) as $index) {
            DB::table('role_user')->insert([
                'role_id' => 4,
                'user_id' => $index,
            ]);
        }

    }
}

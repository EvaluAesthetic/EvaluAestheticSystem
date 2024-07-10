<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        $roles = DB::table('roles')->pluck('id');
        $users = DB::table('users')->pluck('id');
        DB::table('role_user')->insert([
           'role_id' => 2,
           'user_id' => 1,
        ]);

        foreach ($users as $userId) {
            DB::table('role_user')->insert([
                'role_id' => $roles->random(),
                'user_id' => $userId,
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class UserRoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Corp\User::class)->create()->each(function ($user) {
            DB::table('role_user')->insert(['user_id'=>$user->id,'role_id'=>1]);
        });
    }
}

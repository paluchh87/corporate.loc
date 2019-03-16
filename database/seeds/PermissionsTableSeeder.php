<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Corp\Permission::class, 13)->create();

        for ($i=1;$i<=13;$i++){
            DB::table('permission_role')->insert([
                'role_id' => 1,
                'permission_id'=>$i
            ]);
        }
    }
}

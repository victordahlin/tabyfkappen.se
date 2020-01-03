<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            array(
                'first_name' => 'Sven',
                'last_name' => 'Svensson',
                'email' => 'test@gmail.com',
                'password' => bcrypt('test'),
                'is_admin' => false,
                "activation_code" => "",
            ),
            array(
                'first_name' => 'Admin',
                'last_name' => '',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'is_admin' => true,
                "activation_code" => "",
            ),
        ));
    }
}

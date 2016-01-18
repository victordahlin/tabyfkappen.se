<?php

use Illuminate\Database\Seeder;

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
                'first_name'=>'Sven',
                'last_name' => 'Svensson',
                'email'=>'victordahlin@gmail.com',
                'password' => bcrypt('test'),
                'is_admin' => false
            ),
            array(
                'first_name'=>'Admin',
                'last_name' => '',
                'email'=>'admin@admin.com',
                'password' => bcrypt('admin'),
                'is_admin' => true
            ),
        ));
    }
}
